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
    protected $listen = array(
        'Illuminate\Auth\Events\Registered' => array(
            'Illuminate\Auth\Listeners\SendEmailVerificationNotification',
        ),
        'Illuminate\Auth\Events\Logout' => array(
            'App\Listeners\Activity\LogSuccessfulLogout',
        ),
        'Illuminate\Auth\Events\Failed' => array(
            'App\Listeners\Activity\LogAuthFailed',
        ),

        // MBO LISTENERS
        // Campaigns
        'App\Events\MBO\Campaigns\UserCampaignAssigned' => array(
            'App\Listeners\MBO\Campaigns\UserAssignObjectives',
        ),
        'App\Events\MBO\Campaigns\CampaignUpdated' => array(
            'App\Listeners\MBO\Campaigns\UserCampaignStageCheck',
        ),
        'App\Events\MBO\Campaigns\CampaignViewed' => array(
            'App\Listeners\MBO\Campaigns\UserCampaignStageCheck',
        ),

        // Objectives
        'App\Events\MBO\Objectives\ObjectiveUpdated' => array(
            'App\Listeners\MBO\Objectives\UserObjectiveStatusCheck',
        ),
        'App\Events\MBO\Objectives\ObjectiveCreated' => array(
            'App\Listeners\MBO\Objectives\UserObjectiveStatusCheck',
        ),
    );

    /**
     * Register any events for your application.
     */
    public function boot(): void {}

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
