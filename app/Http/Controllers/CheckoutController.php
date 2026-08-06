<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutStoreRequest;
use App\Models\Payment;
use App\Models\ResumeTemplate;
use App\Services\PayMongoClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;

class CheckoutController extends Controller
{
    /**
     * Maps our internal payment method keys to PayMongo's payment_method_types values.
     *
     * @var array<string, string>
     */
    private const METHOD_MAP = [
        'gcash' => 'gcash',
        'maya' => 'paymaya',
        'grab_pay' => 'grab_pay',
        'card' => 'card',
        'qrph' => 'qrph',
    ];

    public function __construct(private readonly PayMongoClient $payMongo)
    {
    }

    /**
     * Create a pending Payment and a matching PayMongo Checkout Session,
     * then hand the frontend the hosted checkout URL to redirect to.
     */
    public function store(CheckoutStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $template = ResumeTemplate::where('is_active', true)->findOrFail($data['resume_template_id']);

        $payment = Payment::create([
            'resume_template_id' => $template->id,
            'customer_name' => $data['customer_name'] ?? null,
            'customer_email' => $data['customer_email'] ?? null,
            'amount' => $template->price,
            'method' => $data['method'],
            'status' => Payment::STATUS_PENDING,
            'download_token' => Str::random(40),
        ]);

        $billing = array_filter([
            'name' => $payment->customer_name,
            'email' => $payment->customer_email,
        ]);

        $attributes = [
            'line_items' => [[
                'name' => "{$template->name} template — ResumAE PDF",
                'amount' => (int) round(((float) $template->price) * 100),
                'currency' => 'PHP',
                'quantity' => 1,
            ]],
            'payment_method_types' => [self::METHOD_MAP[$payment->method] ?? 'card'],
            'success_url' => route('checkout.return', ['payment' => $payment->id, 'result' => 'success']),
            'cancel_url' => route('checkout.return', ['payment' => $payment->id, 'result' => 'cancel']),
            'description' => "ResumAE — {$template->name} template PDF",
            'reference_number' => (string) $payment->id,
            'send_email_receipt' => false,
        ];

        // PayMongo expects `billing` to be a JSON object — an empty PHP
        // array would encode as `[]` and get rejected, so this key is only
        // included when there's actually something in it.
        if ($billing) {
            $attributes['billing'] = $billing;
        }

        try {
            $session = $this->payMongo->createCheckoutSession($attributes);
        } catch (RuntimeException $e) {
            Log::error('PayMongo checkout session creation failed', ['payment_id' => $payment->id, 'message' => $e->getMessage()]);
            $payment->update(['status' => Payment::STATUS_FAILED]);

            return response()->json([
                'message' => "We couldn't start checkout right now. Please try again in a moment.",
            ], 502);
        }

        $payment->update(['reference' => $session['id']]);

        return response()->json(['checkout_url' => $session['attributes']['checkout_url']]);
    }

    /**
     * Handle the customer bouncing back from PayMongo's hosted checkout page.
     * The redirect itself is not trusted — we re-fetch the session from
     * PayMongo (server to server) to confirm the actual payment status.
     */
    public function return(Request $request, Payment $payment): RedirectResponse
    {
        if ($payment->reference && $payment->status === Payment::STATUS_PENDING) {
            try {
                $session = $this->payMongo->getCheckoutSession($payment->reference);

                $paid = collect($session['attributes']['payments'] ?? [])
                    ->contains(fn ($p) => ($p['attributes']['status'] ?? null) === 'paid');

                if ($paid) {
                    $payment->update([
                        'status' => Payment::STATUS_PAID,
                        'paid_at' => now(),
                    ]);
                } elseif ($request->query('result') === 'cancel') {
                    $payment->update(['status' => Payment::STATUS_FAILED]);
                }
            } catch (RuntimeException $e) {
                Log::error('PayMongo checkout session lookup failed', ['payment_id' => $payment->id, 'message' => $e->getMessage()]);
            }
        }

        $paid = $payment->status === Payment::STATUS_PAID;

        return redirect()->route('builder', array_filter([
            'template' => $payment->resumeTemplate?->key,
            'payment' => $paid ? 'success' : 'failed',
            'token' => $paid ? $payment->download_token : null,
        ]));
    }
}
