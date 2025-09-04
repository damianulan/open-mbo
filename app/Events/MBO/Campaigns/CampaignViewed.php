<?php

namespace App\Events\MBO\Campaigns;

use App\Models\MBO\Campaign;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CampaignViewed implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Campaign $campaign
    ) {}
}
