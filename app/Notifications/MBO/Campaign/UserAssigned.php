<?php

namespace App\Notifications\MBO\Campaign;

use App\Models\MBO\Campaign;
use App\Support\Notifications\AppNotification;
use App\Support\Notifications\BaseNotification;
use App\Support\Notifications\Contracts\IsAppNotification;
use Illuminate\Bus\Queueable;

class UserAssigned extends BaseNotification implements IsAppNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Campaign $campaign
    ) {}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toApp(object $notifiable): AppNotification
    {
        return AppNotification::make(__('notifications.app.campaign.user_assigned', [
            'campaignname' => $this->campaign->name,
        ]), 'bi-person-fill-up');
    }
}
