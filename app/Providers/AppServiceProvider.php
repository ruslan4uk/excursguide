<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
            $user = \Auth::user();
    
            // other application logic...
            \Auth::check() 
                ? $view->with('uu', \App\User::where('id', \Auth::id())->first())
                : \Auth::check();
            \Auth::check() 
                ? $view->with('udata', \App\UserData::where('user_id', \Auth::id())->first())
                : \Auth::check();
        });
        
        Schema::defaultStringLength(191);
    }
}
