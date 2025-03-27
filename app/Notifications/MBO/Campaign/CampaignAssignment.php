<?php

namespace App\Notifications\MBO\Campaign;

use Illuminate\Bus\Queueable;
use App\Facades\Notifications\BaseNotification;
use App\Models\Core\User;
use App\Facades\Notifications\NotificationAdhoc;
use App\Models\MBO\Campaign;

class CampaignAssignment extends BaseNotification
{
    use Queueable;
    public User $assigned;
    public Campaign $campaign;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $assigned, Campaign $campaign)
    {
        $this->assigned = $assigned;
        $this->campaign = $campaign;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return NotificationAdhoc::make(__('notifications.app.campaign_assignment', [
            'username' => $this->assigned->name(),
            'campaignname' => $this->campaign->name,
        ]), 'bi-person-fill-up')->toArray();
    }
}
