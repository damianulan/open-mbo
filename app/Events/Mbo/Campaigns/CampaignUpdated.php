<?php

namespace App\Events\Mbo\Campaigns;

use App\Models\Mbo\Campaign;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CampaignUpdated implements ShouldDispatchAfterCommit
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public Campaign $campaign,
    ) {
    }
}
