<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
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
        RedirectIfAuthenticated::redirectUsing(function () {
            $user = Auth::user();
            if($user->hasRole('super-admin|admin')){
                return route('admin.user.list', absolute: false);
            }else if($user->hasRole(['staff'])){
                return route('staff.profile', ['user_id' => $user->id, 'page' => 'main'],  absolute: false);
            }
        });

        if(app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
