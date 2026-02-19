<?php

namespace App\Services\Campaigns;

use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserCampaign;
use Lucent\Services\Service;

class BulkAssignUsers extends Service
{
    public function handle(): Campaign
    {
        $current = UserCampaign::where('campaign_id', $this->campaign->id)->get();
        $current_ids = $current->pluck('user_id')->flip();

        if ($this->request()->input('user_ids')) {
            foreach ($this->request()->input('user_ids') as $user_id) {
                if ( ! $current_ids->has($user_id)) {
                    $this->campaign->assignUser($user_id);
                } else {
                    $current_ids->forget($user_id);
                }
            }

            foreach ($current_ids as $user_id => $key) {
                $this->campaign->unassignUser($user_id);
            }
        }

        return $this->campaign;
    }

}
