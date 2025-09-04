<?php

namespace App\Listeners\MBO\Campaigns;

use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Notifications\MBO\Campaign\CampaignAssignment;
use App\Notifications\MBO\Campaign\UserAssigned;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;

class UserAssignedNotify implements ShouldQueueAfterCommit
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
        $campaign = $event->userCampaign->campaign;
        $coordinators = $campaign->coordinators;
        $user = $event->userCampaign->user;
        if ($coordinators && $coordinators->count()) {
            foreach ($coordinators as $coordinator) {
                $coordinator->notify(new CampaignAssignment($user, $event->userCampaign->campaign));
            }
        }

        $user->notify(new UserAssigned($campaign));
    }
}
