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
        $campaign = $event->campaign;
        if ($event instanceof CampaignUpdated) {
            $campaign->setStageAuto()->updateQuietly();
            $campaign->setUserStage();
        }
    }
}
