<?php

namespace App\Observers\MBO\Objectives;

use App\Models\MBO\UserObjective;
use App\Events\MBO\Campaigns\CampaignUserObjectiveAssigned;
use App\Events\MBO\Objectives\UserObjectiveAssigned;

class UserObjectiveObserver
{
    /**
     * Handle the UserObjective "created" event.
     */
    public function created(UserObjective $model): void
    {
        $campaign = $model->objective->campaign ?? null;
        if ($campaign) {
            CampaignUserObjectiveAssigned::dispatch($model->user, $model->objective, $campaign);
        } else {
            UserObjectiveAssigned::dispatch($model->user, $model->objective);
        }
    }

    /**
     * Handle the UserObjective "updated" event.
     */
    public function updated(UserObjective $model): void {}

    /**
     * Handle the UserObjective "deleted" event.
     */
    public function deleted(UserObjective $model): void
    {

        UserObjectiveUnassigned::dispatch($model->user, $model->campaign);
    }

    /**
     * Handle the UserObjective "restored" event.
     */
    public function restored(UserObjective $model): void
    {
        //
    }

    /**
     * Handle the UserObjective "force deleted" event.
     */
    public function forceDeleted(UserObjective $model): void
    {
        //
    }
}
