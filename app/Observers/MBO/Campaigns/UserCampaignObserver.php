<?php

namespace App\Observers\MBO\Campaigns;

use App\Models\MBO\UserCampaign;
use App\Models\MBO\UserObjective;

use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Events\MBO\Campaigns\UserCampaignUnassigned;

class UserCampaignObserver
{
    /**
     * Handle the UserCampaign "created" event.
     */
    public function created(UserCampaign $model): void
    {
        $objectives = $model->campaign->objectives()->get();
        foreach ($objectives as $objective) {
            UserObjective::assign($model->user_id, $objective->id);
        }

        UserCampaignAssigned::dispatch($model->user, $model->campaign);
    }

    /**
     * Handle the UserCampaign "updated" event.
     */
    public function updated(UserCampaign $model): void
    {
        $model->mapObjectiveStatus();
    }

    /**
     * Handle the UserCampaign "deleted" event.
     */
    public function deleted(UserCampaign $model): void
    {
        $objectives = $model->campaign->objectives()->get();
        foreach ($objectives as $objective) {
            UserObjective::unassign($model->user_id, $objective->id);
        }

        UserCampaignUnassigned::dispatch($model->user, $model->campaign);
    }

    /**
     * Handle the UserCampaign "restored" event.
     */
    public function restored(UserCampaign $model): void
    {
        //
    }

    /**
     * Handle the UserCampaign "force deleted" event.
     */
    public function forceDeleted(UserCampaign $model): void
    {
        //
    }
}
