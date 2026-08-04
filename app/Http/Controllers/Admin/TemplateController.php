<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TemplateStoreRequest;
use App\Http\Requests\Admin\TemplateUpdateRequest;
use App\Models\ResumeTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class TemplateController extends Controller
{
    /**
     * Display a listing of the templates.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Templates/Index', [
            'templates' => ResumeTemplate::orderBy('sort_order')->get(),
        ]);
    }

    /**
     * Show the form for creating a new template.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Templates/Create', [
            'availableKeys' => ResumeTemplate::AVAILABLE_KEYS,
            'usedKeys' => ResumeTemplate::pluck('key'),
        ]);
    }

    /**
     * Store a newly created template.
     */
    public function store(TemplateStoreRequest $request): RedirectResponse
    {
        ResumeTemplate::create($request->validated());

        return Redirect::route('admin.templates.index')->with('status', 'Template created.');
    }

    /**
     * Show the form for editing a template.
     */
    public function edit(ResumeTemplate $template): Response
    {
        return Inertia::render('Admin/Templates/Edit', [
            'template' => $template,
            'availableKeys' => ResumeTemplate::AVAILABLE_KEYS,
            'usedKeys' => ResumeTemplate::where('id', '!=', $template->id)->pluck('key'),
        ]);
    }

    /**
     * Update a template.
     */
    public function update(TemplateUpdateRequest $request, ResumeTemplate $template): RedirectResponse
    {
        $template->update($request->validated());

        return Redirect::route('admin.templates.index')->with('status', 'Template updated.');
    }

    /**
     * Remove a template.
     */
    public function destroy(ResumeTemplate $template): RedirectResponse
    {
        $template->delete();

        return Redirect::route('admin.templates.index')->with('status', 'Template deleted.');
    }

    /**
     * Toggle a template's active status.
     */
    public function toggle(ResumeTemplate $template): RedirectResponse
    {
        $template->update(['is_active' => ! $template->is_active]);

        return Redirect::route('admin.templates.index');
    }
}
