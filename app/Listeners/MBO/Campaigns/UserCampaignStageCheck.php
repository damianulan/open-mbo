<?php

namespace App\Listeners\MBO\Campaigns;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\MBO\Campaigns\CampaignCreated;
use App\Events\MBO\Campaigns\CampaignUpdated;
use App\Events\MBO\Campaigns\CampaignViewed;

class UserCampaignStageCheck
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
    public function handle(CampaignUpdated|CampaignViewed $event): void
    {
        $event->campaign->setUserStage();
    }
}
