<?php

namespace App\Notifications\MBO\Campaign;

use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Support\Notifications\BaseNotification;
use App\Support\Notifications\NotificationAdhoc;
use Illuminate\Bus\Queueable;

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
