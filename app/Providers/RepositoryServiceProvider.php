<?php

namespace App\Providers;

use App\Contracts\Repositories\CampaignRepositoryContract;
use App\Contracts\Repositories\ObjectiveRepositoryContract;
use App\Contracts\Repositories\UserCampaignRepositoryContract;
use App\Contracts\Repositories\UserObjectiveRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Repositories\Mbo\CampaignRepository;
use App\Repositories\Mbo\ObjectiveRepository;
use App\Repositories\Mbo\UserCampaignRepository;
use App\Repositories\Mbo\UserObjectiveRepository;
use App\Repositories\Users\UserRepository;
use App\Support\Filters\Contracts\FilterCollection;
use App\Support\Filters\Services\FilterService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerFilterServices();
        $this->registerRepositories();
    }

    public function boot(): void {}

    private function registerRepositories(): void
    {
        $this->app->bind(CampaignRepositoryContract::class, CampaignRepository::class);
        $this->app->bind(ObjectiveRepositoryContract::class, ObjectiveRepository::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserCampaignRepositoryContract::class, UserCampaignRepository::class);
        $this->app->bind(UserObjectiveRepositoryContract::class, UserObjectiveRepository::class);
    }

    private function registerFilterServices(): void
    {
        $this->app->bind(FilterCollection::class, FilterService::class);

    }
}
