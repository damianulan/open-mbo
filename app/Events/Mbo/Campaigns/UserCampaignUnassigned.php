<?php

namespace App\Events\Mbo\Campaigns;

use App\Models\Mbo\UserCampaign;
use App\Support\Notifications\Contracts\NotifiableEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCampaignUnassigned implements NotifiableEvent
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public UserCampaign $userCampaign,
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
