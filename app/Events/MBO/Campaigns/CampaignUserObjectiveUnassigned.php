<?php

namespace App\Events\MBO\Campaigns;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\MBO\Campaign;
use App\Models\Core\User;
use App\Models\MBO\Objective;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class CampaignUserObjectiveUnassigned implements ShouldDispatchAfterCommit
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
