<?php

namespace App\Listeners\Mbo\Campaigns;

use App\Events\Mbo\Campaigns\UserCampaignAssigned;
use App\Models\Mbo\UserObjective;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserAssignObjectives implements ShouldQueue
{
    use InteractsWithQueue;

    public $tries = 3;

    public $timeout = 300;

    public function __construct() {}

    public function handle(UserCampaignAssigned $event): void
    {
        $model = $event->userCampaign;

        $objectives = $model->campaign->objectives;
        foreach ($objectives as $objective) {
            UserObjective::assign($model->user_id, $objective->id);
        }
    }
}
