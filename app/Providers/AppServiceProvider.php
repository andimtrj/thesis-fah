<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $routeName = request()->route() ? request()->route()->getName() : null;
            $pageTitle = 'Default Title'; // Judul Default
    
            if ($routeName === 'branch') {
                $pageTitle = 'Branch Page';
            } elseif ($routeName === 'product') {
                $pageTitle = 'Product Page';
            }
    
            $view->with('title', $pageTitle);
        });
    }
}
