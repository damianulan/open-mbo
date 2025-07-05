<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\Activity\LogSuccessfulLogout',
        ],
        'Illuminate\Auth\Events\Failed' => [
            'App\Listeners\Activity\LogAuthFailed',
        ],
        'Illuminate\Notifications\Events\NotificationSent' => [
            'App\Listeners\Activity\NotificationLog',
        ],

        // MBO LISTENERS
        'App\Events\MBO\Campaigns\UserCampaignAssigned' => [
            'App\Listeners\MBO\Campaigns\UserAssignedNotify',
        ],
        'App\Events\MBO\Campaigns\UserCampaignUnassigned' => [
            'App\Listeners\MBO\Campaigns\UserUnassignedNotify',
        ],

        'App\Events\MBO\Campaigns\CampaignUpdated' => [
            'App\Listeners\MBO\Campaigns\UserCampaignStageCheck',
        ],
        'App\Events\MBO\Campaigns\CampaignViewed' => [
            'App\Listeners\MBO\Campaigns\UserCampaignStageCheck',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

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
