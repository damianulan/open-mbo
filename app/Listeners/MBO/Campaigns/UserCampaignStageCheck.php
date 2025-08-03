<?php

namespace App\Listeners\MBO\Campaigns;

use App\Events\MBO\Campaigns\CampaignUpdated;
use App\Events\MBO\Campaigns\CampaignViewed;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;

class UserCampaignStageCheck implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;
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
        if ($event instanceof CampaignUpdated) {
            $event->campaign->setUserStage();
        }
    }
}
