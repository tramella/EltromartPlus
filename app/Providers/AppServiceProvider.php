<?php

namespace App\Providers;

use App\Models\Brands;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS scheme in production/reverse-proxy deployment to prevent mixed-content CSS/JS blocking
        if ($this->app->environment('production') || request()->header('x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }

        view()->composer('layouts.app', function ($view) {
            $brand = Brands::take(4)->get();
            $view->with('brands', $brand);
        });
    }
}
