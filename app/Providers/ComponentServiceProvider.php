<?php

namespace App\Providers;

use App\View\Components\CourseProgressBar;
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
        Blade::component('course-progressbar', CourseProgressBar::class);

        // @radial_gradient css directive
        Blade::directive('radial_gradient', function ($secondary) {
            return 'style="background: rgb(86,77,128);background: radial-gradient(circle, rgba(86,77,128,1) 0%, rgba('.$secondary.',1) 100%);"';
        });
    }
}