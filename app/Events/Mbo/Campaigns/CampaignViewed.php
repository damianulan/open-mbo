<?php

namespace App\Events\Mbo\Campaigns;

use App\Models\Mbo\Campaign;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CampaignViewed
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Campaign $campaign
    ) {}
}
