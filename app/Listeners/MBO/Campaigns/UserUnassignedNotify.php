<?php

namespace App\Listeners\MBO\Campaigns;

use App\Events\MBO\Campaigns\UserCampaignUnassigned;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;

class UserUnassignedNotify implements ShouldQueueAfterCommit
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCampaignUnassigned $event): void {}
}
