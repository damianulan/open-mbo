<?php

namespace App\Support\UI\Page;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('sidebar', fn () => app('page')->getNavigation()?->renderSidebar());
        Blade::directive('topbar', fn () => app('page')->getNavigation()?->renderTopbar());
        Blade::directive('pagenav', fn () => app('page')->getNavigation()?->renderPageNav());
    }
}
