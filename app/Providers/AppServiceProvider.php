<?php

namespace App\Providers;

use App\Services\PayMongoClient;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PayMongoClient::class, fn () => new PayMongoClient(
            config('services.paymongo.secret_key'),
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
