<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;

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
        // Configure the paginator to use Tailwind CSS
        Paginator::useTailwind();
        
        // Add withQueryString method to all paginator instances
        $this->app->resolving(LengthAwarePaginator::class, function ($paginator) {
            return $paginator->withQueryString();
        });
    }
}
