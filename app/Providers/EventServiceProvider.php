<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        'Illuminate\Auth\Events\Registered' => [
            'Illuminate\Auth\Listeners\SendEmailVerificationNotification',
        ],
        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\Activity\LogSuccessfulLogout',
        ],
        'Illuminate\Auth\Events\Failed' => [
            'App\Listeners\Activity\LogAuthFailed',
        ],

        // MBO LISTENERS
        // Campaigns
        'App\Events\MBO\Campaigns\UserCampaignAssigned' => [
            'App\Listeners\MBO\Campaigns\UserAssignObjectives',
        ],
        'App\Events\MBO\Campaigns\CampaignUpdated' => [
            'App\Listeners\MBO\Campaigns\UserCampaignStageCheck',
        ],
        'App\Events\MBO\Campaigns\CampaignViewed' => [
            'App\Listeners\MBO\Campaigns\UserCampaignStageCheck',
        ],

        // Objectives
        'App\Events\MBO\Objectives\ObjectiveUpdated' => [
            'App\Listeners\MBO\Objectives\UserObjectiveStatusCheck',
        ],
        'App\Events\MBO\Objectives\ObjectiveCreated' => [
            'App\Listeners\MBO\Objectives\UserObjectiveStatusCheck',
        ],

        'App\Events\MBO\Objectives\UserObjectiveEvaluated' => [
            'App\Listeners\MBO\Objectives\UserObjectiveEvaluation',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void {}

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
