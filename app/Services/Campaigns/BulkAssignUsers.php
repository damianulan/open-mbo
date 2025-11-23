<?php

namespace App\Services\Campaigns;

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
                    $this->assignUser($user_id);
                } else {
                    $current_ids->forget($user_id);
                }
            }

            foreach ($current_ids as $user_id => $key) {
                $this->unassignUser($user_id);
            }
        }

        return $this->campaign;
    }

    public function assignUser($user_id): bool
    {
        $result = false;
        $exists = $this->campaign->user_campaigns()->where('user_id', $user_id)->exists();
        if ( ! $exists) {
            $result = $this->campaign->user_campaigns()->create([
                'user_id' => $user_id,
                'stage' => $this->campaign->setUserStage($user_id),
                'manual' => $this->campaign->manual,
                'active' => $this->campaign->draft ? 0 : 1,
            ]);
        }

        return $result ? true : false;
    }

    public function unassignUser($user_id): bool
    {
        $result = false;
        $record = $this->campaign->user_campaigns()->where('user_id', $user_id)->first();
        if ($record) {
            $result = $record->delete();
        }

        return $result ? true : false;
    }
}
