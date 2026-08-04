<?php

namespace App\Http\Controllers;

use App\Models\ResumeTemplate;
use Inertia\Inertia;
use Inertia\Response;

class LandingController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index(): Response
    {
        return Inertia::render('Landing', [
            'templates' => ResumeTemplate::where('is_active', true)
                ->orderBy('sort_order')
                ->get(['id', 'key', 'name', 'description', 'price']),
        ]);
    }
}
