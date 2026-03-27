<?php

namespace App\Listeners\Mbo\Campaigns;

use App\Events\Mbo\Campaigns\CampaignUpdated;
use App\Events\Mbo\Campaigns\CampaignViewed;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;

class UserCampaignStageCheck implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;

    public $timeout = 180;

    /**
     * Create the event listener.
     */
    public function __construct() {}

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
