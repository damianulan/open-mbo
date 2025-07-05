<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('role', function ($role) {
            return auth()->user()->hasRole($role);
        });

        Blade::if('admin', function () {
            return auth()->user()->isAdmin();
        });

        Blade::if('root', function () {
            return auth()->user()->isRoot();
        });
    }
}
