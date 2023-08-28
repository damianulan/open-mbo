<?php

namespace App\Providers;

use App\View\Components\CardProgressBar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ComponentServiceProvider extends ServiceProvider
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
        // Progressbar component
        Blade::component('card-progressbar', CardProgressBar::class);
    }
}
