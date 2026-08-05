<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/builder', [BuilderController::class, 'index'])->name('builder');

Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'), 'changefreq' => 'weekly', 'priority' => '1.0'],
        ['loc' => url('/builder'), 'changefreq' => 'weekly', 'priority' => '0.9'],
    ];

    return Response::view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::patch('/templates/{template}/toggle', [TemplateController::class, 'toggle'])->name('templates.toggle');
        Route::resource('templates', TemplateController::class)->except('show');
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    });
});

require __DIR__.'/auth.php';
