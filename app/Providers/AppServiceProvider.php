<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ShortUrlService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NombreDelServicio::class, function ($app) {
            return new ShortUrlService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
