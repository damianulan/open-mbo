<?php

namespace App\Notifications\MBO\Campaign;

use App\Models\MBO\Campaign;
use App\Support\Notifications\BaseNotification;
use App\Support\Notifications\NotificationAdhoc;
use Illuminate\Bus\Queueable;

class UserAssigned extends BaseNotification
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
    public function toArray(object $notifiable): array
    {
        return NotificationAdhoc::make(__('notifications.app.campaign.user_assigned', [
            'campaignname' => $this->campaign->name,
        ]), 'bi-person-fill-up')->toArray();
    }
}
