<?php

namespace App\Events\MBO\Campaigns;

use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CampaignUserObjectiveUnassigned implements ShouldDispatchAfterCommit
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     * @param User $user
     * @param Objective $objective
     * @param Campaign $campaign
     */
    public function __construct(
        public User $user,
        public Objective $objective,
        public Campaign $campaign
    ) {}
}
