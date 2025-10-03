<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Program;



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
         // layout.header-д programs дамжуулах
    View::composer('layout.header', function ($view) {
        $programs = Program::with('translations')
            ->where('is_active', 1)
            ->orderBy('order', 'asc')
            ->get();
        $view->with('programs', $programs);
    });

    // customer.layout.header-д programs дамжуулах
    View::composer('customer.layout.header', function ($view) {
        $programs = Program::with('translations')
            ->where('is_active', 1)
            ->orderBy('order', 'asc')
            ->get();
        $view->with('programs', $programs);
    });
        Paginator::useBootstrap();
        View::composer('*', function ($view) {
        if (Auth::check()) {
            $notifications = Auth::user()->unreadNotifications()->take(5)->get();
            $view->with('adminNotifications', $notifications);
        }
    });

    }

}
