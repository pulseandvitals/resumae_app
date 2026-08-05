<?php

namespace App\Http\Controllers;

use App\Models\ResumeTemplate;
use Inertia\Inertia;
use Inertia\Response;

class BuilderController extends Controller
{
    /**
     * Display the resume builder.
     */
    public function index(): Response
    {
        return Inertia::render('Builder/Index', [
            'templates' => ResumeTemplate::where('is_active', true)
                ->orderBy('sort_order')
                ->get(['id', 'key', 'name', 'description', 'recommended_roles', 'price']),
        ]);
    }
}
