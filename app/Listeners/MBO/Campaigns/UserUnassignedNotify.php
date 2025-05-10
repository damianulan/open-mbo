<?php

namespace App\Listeners\MBO\Campaigns;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\MBO\Campaign\CampaignAssignment;
use App\Events\MBO\Campaigns\UserCampaignUnassigned;

class UserUnassignedNotify
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
