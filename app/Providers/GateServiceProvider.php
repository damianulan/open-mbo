<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Policies\MBO\CampaignPolicy;
use App\Models\MBO\Objective;
use App\Policies\MBO\ObjectivePolicy;

class GateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::policy(Campaign::class, CampaignPolicy::class);
        Gate::policy(Objective::class, ObjectivePolicy::class);
    }
}
