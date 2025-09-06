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
        Illuminate\Auth\Events\Logout::class => [
            App\Listeners\Activity\LogSuccessfulLogout::class,
        ],
        Illuminate\Auth\Events\Failed::class => [
            App\Listeners\Activity\LogAuthFailed::class,
        ],
        Illuminate\Notifications\Events\NotificationSent::class => [
            App\Listeners\Activity\NotificationLog::class,
        ],

        // MBO LISTENERS
        App\Events\MBO\Campaigns\UserCampaignAssigned::class => [
            App\Listeners\MBO\Campaigns\UserAssignedNotify::class,
            App\Listeners\MBO\Campaigns\UserAssignObjectives::class,
        ],
        App\Events\MBO\Campaigns\UserCampaignUnassigned::class => [
            App\Listeners\MBO\Campaigns\UserUnassignedNotify::class,
        ],

        App\Events\MBO\Campaigns\CampaignUpdated::class => [
            App\Listeners\MBO\Campaigns\UserCampaignStageCheck::class,
        ],
        App\Events\MBO\Campaigns\CampaignViewed::class => [
            App\Listeners\MBO\Campaigns\UserCampaignStageCheck::class,
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
