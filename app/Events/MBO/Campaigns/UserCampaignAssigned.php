<?php

namespace App\Events\MBO\Campaigns;

use App\Models\MBO\UserCampaign;
use App\Support\Notifications\Contracts\NotifiableEvent;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCampaignAssigned implements ShouldDispatchAfterCommit, NotifiableEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public UserCampaign $userCampaign
    ) {
        //
    }

    public function notifiable(): Model
    {
        return $this->userCampaign->user;
    }
}
