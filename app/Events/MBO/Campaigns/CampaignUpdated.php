<?php

namespace App\Events\MBO\Campaigns;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\MBO\Campaign;
use App\Models\Core\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class CampaignUpdated implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Campaign $campaign
    ) {}
}
