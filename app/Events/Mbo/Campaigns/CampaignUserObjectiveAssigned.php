<?php

namespace App\Events\Mbo\Campaigns;

use App\Models\Core\User;
use App\Models\Mbo\Campaign;
use App\Models\Mbo\Objective;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CampaignUserObjectiveAssigned implements ShouldDispatchAfterCommit
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public User $user,
        public Objective $objective,
        public Campaign $campaign,
    ) {}
}
