<?php

namespace App\Services\Campaigns;

use App\Contracts\Repositories\UserCampaignRepositoryContract;
use App\Models\Mbo\Campaign;
use Lucent\Services\Service;

class BulkAssignUsers extends Service
{
    public function handle(): Campaign
    {
        $current = app(UserCampaignRepositoryContract::class)
            ->getAssignmentsForCampaign($this->campaign->id);
        $current_ids = $current->pluck('user_id')->flip();

        if ($this->request()->input('user_ids')) {
            foreach ($this->request()->input('user_ids') as $user_id) {
                if (! $current_ids->has($user_id)) {
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
