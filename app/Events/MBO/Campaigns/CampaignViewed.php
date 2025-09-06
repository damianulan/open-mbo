<?php

namespace App\Events\MBO\Campaigns;

use App\Models\MBO\Campaign;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CampaignViewed
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Campaign $campaign
    ) {}
}
