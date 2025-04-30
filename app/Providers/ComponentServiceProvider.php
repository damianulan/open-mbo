<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('icon', \App\View\Components\Layout\IconComponent::class);
        Blade::component('notification-dropdown', \App\View\Components\Layout\NotificationDropdown::class);
        Blade::component('tile-button', \App\View\Components\Layout\TileButton::class);

        // MBO components
        Blade::component('card-progressbar', \App\View\Components\MBO\Campaign\CardProgressBar::class);
        Blade::component('objectives-list', \App\View\Components\MBO\Objectives\ObjectivesList::class);
        Blade::component('objective-users-list', \App\View\Components\MBO\Objectives\ObjectiveUsersList::class);
        Blade::component('campaign-users-list', \App\View\Components\MBO\Campaign\CampaignUsersList::class);
    }
}
