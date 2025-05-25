<?php

namespace App\Events\MBO\Campaigns;

use App\Models\MBO\UserCampaign;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class UserCampaignUpdated implements ShouldDispatchAfterCommit
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
}
