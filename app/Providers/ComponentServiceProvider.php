<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ComponentServiceProvider extends ServiceProvider
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
        Blade::if('settings', fn ($key) => settings($key));

        Blade::component('icon', \App\View\Components\Layout\IconComponent::class);
        Blade::component('tile-button', \App\View\Components\Layout\TileButton::class);

        // MBO components
        Blade::component('card-progressbar', \App\View\Components\MBO\Campaign\CardProgressBar::class);
        Blade::component('campaign-users-list', \App\View\Components\MBO\Campaign\CampaignUsersList::class);

        Blade::component('objectives-list', \App\View\Components\MBO\Objectives\ObjectivesList::class);
        Blade::component('objective-users-list', \App\View\Components\MBO\Objectives\ObjectiveUsersList::class);
        Blade::component('objective-summary', \App\View\Components\MBO\Objectives\ObjectiveSummary::class);

        // Users
        Blade::component('user-details-card', \App\View\Components\Users\UserDetailsCard::class);
        Blade::component('user-banner', \App\View\Components\Users\UserBanner::class);

        Livewire::component('commentable', \App\Commentable\Components\CommentComponent::class);
        Livewire::component('notifications', \App\Livewire\Layout\Notifications::class);
        Livewire::component('notification.item', \App\Livewire\Layout\Notifications\Item::class);

        Blade::component('note-card', \App\View\Components\Cards\NoteCard::class);
    }
}
