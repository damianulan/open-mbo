<?php

namespace App\Providers;

use App\Commentable\Components\CommentComponent;
use App\Livewire\Layout\Notifications;
use App\Livewire\Layout\Notifications\Item;
use App\View\Components\Cards\NoteCard;
use App\View\Components\Layout\IconComponent;
use App\View\Components\Layout\TileButton;
use App\View\Components\MBO\Campaign\CampaignCard;
use App\View\Components\MBO\Campaign\CampaignUsersList;
use App\View\Components\MBO\Campaign\CardProgressBar;
use App\View\Components\MBO\Campaign\MyCampaignsSummary;
use App\View\Components\MBO\Objectives\ObjectivesList;
use App\View\Components\MBO\Objectives\ObjectiveSummary;
use App\View\Components\MBO\Objectives\ObjectiveUsersList;
use App\View\Components\Users\UserBanner;
use App\View\Components\Users\UserDetailsCard;
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
        Blade::if('settings', fn($key) => settings($key));

        Blade::component('icon', IconComponent::class);
        Blade::component('tile-button', TileButton::class);

        // MBO components
        Blade::component('card-progressbar', CardProgressBar::class);
        Blade::component('campaign-card', CampaignCard::class);
        Blade::component('my-campaigns-summary', MyCampaignsSummary::class);
        Blade::component('campaign-users-list', CampaignUsersList::class);

        Blade::component('objectives-list', ObjectivesList::class);
        Blade::component('objective-users-list', ObjectiveUsersList::class);
        Blade::component('objective-summary', ObjectiveSummary::class);

        // Users
        Blade::component('user-details-card', UserDetailsCard::class);
        Blade::component('user-banner', UserBanner::class);

        Livewire::component('commentable', CommentComponent::class);
        Livewire::component('notifications', Notifications::class);
        Livewire::component('notification.item', Item::class);

        Blade::component('note-card', NoteCard::class);
    }
}
