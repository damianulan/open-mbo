<?php

namespace App\Providers;

use App\Helpers\StorageHelper;
use App\Support\Storage\StorageManager;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ( ! $this->app->environment('production')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
        if ($this->app->environment('local')) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $loader = AliasLoader::getInstance();
        $loader->alias('Debugbar', Debugbar::class);
        $this->app->singleton(StorageManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
