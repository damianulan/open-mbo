<?php

namespace App\Providers;

use App\Commentable\Components\CommentComponent;
use App\Helpers\StorageHelper;
use App\Livewire\Layout\Notifications;
use App\Livewire\Layout\Notifications\Item;
use App\Livewire\Notifications\Index as NotificationsIndex;
use App\View\Components\Cards\NoteCard;
use App\View\Components\Layout\IconComponent;
use App\View\Components\Layout\TileButton;
use App\View\Components\Mbo\Campaign\CampaignCard;
use App\View\Components\Mbo\Campaign\CampaignUsersList;
use App\View\Components\Mbo\Campaign\CardProgressBar;
use App\View\Components\Mbo\Campaign\MyCampaignsSummary;
use App\View\Components\Mbo\Campaign\UserCampaignSummary;
use App\View\Components\Mbo\Objectives\ObjectivesList;
use App\View\Components\Mbo\Objectives\ObjectiveSummary;
use App\View\Components\Mbo\Objectives\ObjectiveUsersList;
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
        Blade::if('settings', fn ($key) => settings($key));

        Blade::component('icon', IconComponent::class);
        Blade::component('tile-button', TileButton::class);

        // MBO components
        Blade::component('card-progressbar', CardProgressBar::class);
        Blade::component('campaign-card', CampaignCard::class);
        Blade::component('my-campaigns-summary', MyCampaignsSummary::class);
        Blade::component('campaign-users-list', CampaignUsersList::class);
        Blade::component('user-campaign-summary', UserCampaignSummary::class);

        Blade::component('objectives-list', ObjectivesList::class);
        Blade::component('objective-users-list', ObjectiveUsersList::class);
        Blade::component('objective-summary', ObjectiveSummary::class);

        // Users
        Blade::component('user-details-card', UserDetailsCard::class);
        Blade::component('user-banner', UserBanner::class);

        Livewire::component('commentable', CommentComponent::class);
        Livewire::component('notifications', Notifications::class);
        Livewire::component('notification.item', Item::class);
        Livewire::component('notifications.index', NotificationsIndex::class);

        Blade::component('note-card', NoteCard::class);

        Blade::directive('branding', fn () => StorageHelper::getBrandingHtml());
    }
}
