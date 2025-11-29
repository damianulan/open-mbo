<?php

namespace App\Events\MBO\Campaigns;

use App\Models\MBO\Campaign;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CampaignViewed
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     * @param Campaign $campaign
     */
    public function __construct(
        public Campaign $campaign
    ) {}
}
