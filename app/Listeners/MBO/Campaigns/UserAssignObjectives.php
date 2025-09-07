<?php

namespace App\Listeners\MBO\Campaigns;

use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Models\MBO\UserObjective;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserAssignObjectives implements ShouldQueue
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
    public function handle(UserCampaignAssigned $event): void
    {
        $model = $event->userCampaign;

        $objectives = $model->campaign->objectives;
        foreach ($objectives as $objective) {
            UserObjective::assign($model->user_id, $objective->id);
        }
    }
}
