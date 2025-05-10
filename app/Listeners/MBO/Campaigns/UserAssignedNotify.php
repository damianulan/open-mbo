<?php

namespace App\Listeners\MBO\Campaigns;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\MBO\Campaign\CampaignAssignment;
use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Notifications\MBO\Campaign\UserAssigned;

class UserAssignedNotify
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
    public function handle(UserCampaignAssigned $event): void
    {
        $coordinators = $event->campaign->coordinators;
        if ($coordinators && $coordinators->count()) {
            foreach ($coordinators as $coordinator) {
                $coordinator->notify(new CampaignAssignment($event->user, $event->campaign));
            }
        }

        $event->user->notify(new UserAssigned($event->campaign));
    }
}
