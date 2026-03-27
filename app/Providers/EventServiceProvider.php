<?php

namespace App\Providers;

use App\Models\Core\User;
use App\Observers\UserObserver;
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
        'Spatie\LaravelSettings\Events\SavingSettings' => [
            'App\Listeners\Vendors\SettingsUpdated',
        ],

        // MBO LISTENERS
        // Campaigns
        'App\Events\Mbo\Campaigns\UserCampaignAssigned' => [
            'App\Listeners\Mbo\Campaigns\UserAssignObjectives',
        ],
        'App\Events\Mbo\Campaigns\CampaignUpdated' => [
            'App\Listeners\Mbo\Campaigns\UserCampaignStageCheck',
        ],
        'App\Events\Mbo\Campaigns\CampaignViewed' => [
            'App\Listeners\Mbo\Campaigns\UserCampaignStageCheck',
        ],

        // Objectives
        'App\Events\Mbo\Objectives\ObjectiveUpdated' => [
            'App\Listeners\Mbo\Objectives\UserObjectiveStatusCheck',
        ],
        'App\Events\Mbo\Objectives\ObjectiveCreated' => [
            'App\Listeners\Mbo\Objectives\UserObjectiveStatusCheck',
        ],

        // BUSINESS
        'App\Events\Core\User\EmploymentCreated' => [
            'App\Listeners\Business\UserEmploymentSaved',
        ],
        'App\Events\Core\User\EmploymentUpdated' => [
            'App\Listeners\Business\UserEmploymentSaved',
        ],
        'App\Events\Core\User\EmploymentDeleted' => [
            'App\Listeners\Business\UserEmploymentSaved',
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
