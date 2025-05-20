<?php

namespace App\Observers\MBO\Campaigns;

use App\Models\MBO\Campaign;
use App\Enums\MBO\CampaignStage;
use App\Events\MBO\Campaigns\CampaignUpdated;
use App\Events\MBO\Campaigns\CampaignCreated;
use Illuminate\Support\Facades\Auth;
use App\Models\Core\User;

class CampaignObserver
{

    protected ?User $user = null;

    public function __construct()
    {
        $this->user = Auth::user() ?? null;
    }

    /**
     * Handle the Campaign "retreived" event.
     */
    public function retrieved(Campaign $campaign): void
    {
        $campaign->setUserStage();
    }

    public function creating(Campaign $campaign): Campaign
    {
        if ($campaign->manual == 0) {
            $campaign->setStageAuto();
        } else {
            $campaign->stage = CampaignStage::PENDING;
        }

        return $campaign;
    }

    /**
     * Handle the Campaign "created" event.
     */
    public function created(Campaign $campaign): void
    {
        CampaignCreated::dispatch($campaign, $this->user);
    }

    public function updating(Campaign $campaign): Campaign
    {
        if (!setting('mbo.campaigns_manual')) {
            $campaign->manual = 0;
        }

        if ($campaign->manual == 0) {
            $campaign->setStageAuto();
        } else {
            $campaign->stage = CampaignStage::PENDING;
        }

        return $campaign;
    }


    /**
     * Handle the Campaign "updated" event.
     */
    public function updated(Campaign $campaign): void
    {
        $campaign->setUserStage();
        CampaignUpdated::dispatch($campaign, $this->user);
    }

    /**
     * Handle the Campaign "deleted" event.
     */
    public function deleted(Campaign $campaign): void
    {
        //
    }

    /**
     * Handle the Campaign "restored" event.
     */
    public function restored(Campaign $campaign): void
    {
        //
    }

    /**
     * Handle the Campaign "force deleted" event.
     */
    public function forceDeleted(Campaign $campaign): void
    {
        //
    }
}
