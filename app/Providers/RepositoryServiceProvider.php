<?php

namespace App\Providers;

use App\Contracts\Repositories\CampaignRepositoryContract;
use App\Repositories\Mbo\CampaignRepository;
use App\Support\Filters\Contracts\FilterCollection;
use App\Support\Filters\Services\FilterService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerFilterServices();

    }

    public function boot(): void {}

    private function registerRepositories(): void
    {
        $this->app->bind(CampaignRepositoryContract::class, CampaignRepository::class);
    }

    private function registerFilterServices(): void
    {
        $this->app->bind(FilterCollection::class, FilterService::class);

    }
}
