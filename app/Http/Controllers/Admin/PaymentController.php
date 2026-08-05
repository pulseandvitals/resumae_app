<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    /**
     * Display payment stats and the most recent payments.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Payments/Index', [
            'stats' => [
                'total' => Payment::count(),
                'paid' => Payment::paid()->count(),
                'paidAndUploaded' => Payment::paid()->pdfUploaded()->count(),
                'revenue' => Payment::paid()->sum('amount'),
            ],
            'recentPayments' => Payment::with('resumeTemplate:id,name')
                ->latest()
                ->limit(20)
                ->get(['id', 'resume_template_id', 'customer_name', 'customer_email', 'amount', 'status', 'method', 'paid_at', 'pdf_uploaded_at', 'created_at']),
        ]);
    }
}
