<?php

namespace App\Notifications\MBO\Campaign;

use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Support\Notifications\AppNotification;
use App\Support\Notifications\BaseNotification;
use App\Support\Notifications\Contracts\IsAppNotification;
use Illuminate\Bus\Queueable;

class CampaignAssignment extends BaseNotification implements IsAppNotification
{
    use Queueable;

    public function __construct(
        public User $assigned,
        public Campaign $campaign
    ) {}

    public function toApp(object $notifiable): AppNotification
    {
        return AppNotification::make(__('notifications.app.campaign.coordinator_assignment', [
            'username' => $this->assigned->name,
            'campaignname' => $this->campaign->name,
        ]), 'bi-person-fill-up');
    }
}
