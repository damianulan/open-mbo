<?php

namespace App\Events\MBO\Campaigns;

use App\Models\MBO\UserCampaign;
use App\Support\Notifications\Contracts\NotifiableEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCampaignUnassigned implements NotifiableEvent
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public UserCampaign $userCampaign
    ) {}

    public static function description(): string
    {
        return 'User campaign unassigned';
    }

    public function notifiable(): Model
    {
        return $this->userCampaign->user;
    }

    public function checkConditions(): bool
    {
        return true;
    }

    public function notificationDelay(): int
    {
        return 0;
    }
}
