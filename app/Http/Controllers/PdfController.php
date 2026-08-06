<?php

namespace App\Http\Controllers;

use App\Http\Requests\PdfStoreRequest;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use Throwable;

class PdfController extends Controller
{
    /**
     * Render the customer's already-paid resume (captured HTML from the
     * live preview) to a real, text-based PDF via headless Chrome, store a
     * copy, and stream it back for download.
     */
    public function store(PdfStoreRequest $request, string $token): Response|JsonResponse
    {
        $payment = Payment::where('download_token', $token)
            ->where('status', Payment::STATUS_PAID)
            ->first();

        if (! $payment) {
            return response()->json([
                'message' => 'This download link is no longer valid — the PDF may have already been downloaded.',
            ], 404);
        }

        $fullHtml = $this->wrapHtml($request->validated('html'));

        try {
            $pdf = Browsershot::html($fullHtml)
                ->format('Letter')
                ->showBackground()
                // Left/right stay 0 — the template's own padding already
                // provides horizontal whitespace. Top/bottom reserve room
                // at every page break so content is never sliced in half;
                // combined with the break-inside:avoid rules below, an
                // entry that doesn't fit is pushed whole to the next page.
                ->margins(10, 0, 15, 0)
                ->waitUntilNetworkIdle()
                ->pdf();
        } catch (Throwable $e) {
            Log::error('PDF generation failed', ['payment_id' => $payment->id, 'message' => $e->getMessage()]);

            return response()->json([
                'message' => "We couldn't generate your PDF right now. Please try again.",
            ], 500);
        }

        $path = "payments/{$payment->id}.pdf";
        Storage::disk('local')->put($path, $pdf);

        // One-time use — erase the token so this link can't generate or
        // re-download the PDF again.
        $payment->update([
            'pdf_path' => $path,
            'pdf_uploaded_at' => now(),
            'download_token' => null,
        ]);

        $filename = Str::slug($payment->resumeTemplate?->name ?? 'resume').'-resume.pdf';

        return response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    /**
     * Wrap the captured template markup in a standalone HTML document with
     * the app's compiled Tailwind CSS inlined, so Browsershot's headless
     * Chrome renders it identically to what the customer saw on screen.
     */
    private function wrapHtml(string $bodyHtml): string
    {
        $css = $this->compiledCss();

        return <<<HTML
            <!doctype html>
            <html>
                <head>
                    <meta charset="utf-8">
                    <style>{$css}</style>
                    <style>
                        * { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                        html, body { margin: 0; padding: 0; }

                        /* Every template lists dated entries (experience,
                           education, projects, etc.) as direct children of
                           a Tailwind space-y-* container — keep each whole
                           entry together rather than splitting it across a
                           page break. */
                        [class*="space-y-"] > * {
                            break-inside: avoid;
                        }

                        /* Never leave a heading stranded alone at the
                           bottom of a page with its content pushed over. */
                        h1, h2, h3 {
                            break-after: avoid;
                            break-inside: avoid;
                        }
                    </style>
                </head>
                <body>{$bodyHtml}</body>
            </html>
            HTML;
    }

    private function compiledCss(): string
    {
        $manifestPath = public_path('build/manifest.json');

        if (! File::exists($manifestPath)) {
            return '';
        }

        $manifest = json_decode(File::get($manifestPath), true);
        $cssFile = $manifest['resources/js/app.js']['css'][0] ?? null;

        if (! $cssFile) {
            return '';
        }

        $cssPath = public_path("build/{$cssFile}");

        return File::exists($cssPath) ? File::get($cssPath) : '';
    }
}
