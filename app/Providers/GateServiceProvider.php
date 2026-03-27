<?php

namespace App\Providers;

use App\Models\Core\User;
use App\Models\Mbo\Campaign;
use App\Models\Mbo\Objective;
use App\Models\Mbo\UserObjective;
use App\Policies\Mbo\CampaignPolicy;
use App\Policies\Mbo\ObjectivePolicy;
use App\Policies\Mbo\UserObjectivePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class GateServiceProvider extends ServiceProvider
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
        Gate::policy(Campaign::class, CampaignPolicy::class);
        Gate::policy(Objective::class, ObjectivePolicy::class);
        Gate::policy(UserObjective::class, UserObjectivePolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}
