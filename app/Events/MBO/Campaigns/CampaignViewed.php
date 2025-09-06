<?php

namespace App\Events\MBO\Campaigns;

use App\Models\MBO\Campaign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

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
