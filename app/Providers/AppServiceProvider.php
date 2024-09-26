<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
        View::composer('sections.aside', function ($view) {
            $user = auth()->user();
            $companies = $user ? $user->companies : collect();

            $currentSlug = Route::current()->parameter('slug');
            $currentCompany  = $companies->firstWhere('slug', $currentSlug);

            $view->with('companies', $companies)
                ->with('currentCompany', $currentCompany);
        });
    }
}
