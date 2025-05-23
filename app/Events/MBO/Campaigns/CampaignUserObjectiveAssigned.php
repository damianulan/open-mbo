<?php

namespace App\Events\MBO\Campaigns;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use App\Models\MBO\Campaign;
use App\Models\Core\User;
use App\Models\MBO\Objective;

class CampaignUserObjectiveAssigned implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user,
        public Objective $objective,
        public Campaign $campaign
    ) {
        //
    }
}
