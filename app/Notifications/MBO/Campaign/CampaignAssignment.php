<?php

namespace App\Notifications\MBO\Campaign;

use Illuminate\Bus\Queueable;
use App\Support\Notifications\BaseNotification;
use App\Models\Core\User;
use App\Support\Notifications\NotificationAdhoc;
use App\Models\MBO\Campaign;

class CampaignAssignment extends BaseNotification
{
    use Queueable;


    /**
     * Create a new notification instance.
     */
    public function __construct(
        public User $assigned,
        public Campaign $campaign
    ) {}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return NotificationAdhoc::make(__('notifications.app.campaign.coordinator_assignment', [
            'username' => $this->assigned->name(),
            'campaignname' => $this->campaign->name,
        ]), 'bi-person-fill-up')->toArray();
    }
}
