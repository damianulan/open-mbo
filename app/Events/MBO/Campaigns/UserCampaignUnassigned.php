<?php

namespace App\Events\MBO\Campaigns;

use App\Models\Core\User;
use App\Models\MBO\Campaign;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCampaignUnassigned implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user,
        public Campaign $campaign
    ) {
        //
    }
}
