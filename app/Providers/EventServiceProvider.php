<?php

namespace App\Providers;

use App\Models\Core\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
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

        'App\Events\Mbo\Campaigns\UserCampaignAssigned' => [
            'App\Listeners\Mbo\Campaigns\UserAssignObjectives',
        ],
        'App\Events\Mbo\Campaigns\CampaignUpdated' => [
            'App\Listeners\Mbo\Campaigns\UserCampaignStageCheck',
        ],
        'App\Events\Mbo\Campaigns\CampaignViewed' => [
            'App\Listeners\Mbo\Campaigns\UserCampaignStageCheck',
        ],

        'App\Events\Mbo\Objectives\ObjectiveUpdated' => [
            'App\Listeners\Mbo\Objectives\UserObjectiveStatusCheck',
        ],
        'App\Events\Mbo\Objectives\ObjectiveCreated' => [
            'App\Listeners\Mbo\Objectives\UserObjectiveStatusCheck',
        ],

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

    public function boot(): void
    {
        User::observe(UserObserver::class);
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
