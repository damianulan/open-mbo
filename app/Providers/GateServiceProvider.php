<?php

namespace App\Providers;

use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Models\MBO\UserObjective;
use App\Policies\MBO\CampaignPolicy;
use App\Policies\MBO\ObjectivePolicy;
use App\Policies\MBO\UserObjectivePolicy;
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
