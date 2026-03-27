<?php

namespace App\Providers;

use App\Support\Filters\Contracts\FilterCollection;
use App\Support\Filters\Services\FilterService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerFilterServices();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}

    private function registerFilterServices(): void
    {
        $this->app->bind(FilterCollection::class, FilterService::class);

    }
}
