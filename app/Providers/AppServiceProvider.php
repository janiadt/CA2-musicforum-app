<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // Telling paginator (the service responsible for displaying the table links) to use bootstrap instead of tailwind
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
