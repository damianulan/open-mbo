<?php

namespace App\Services\Campaigns;

use App\Services\BaseService;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserCampaign;

class CampaignService extends BaseService
{

    public function createOrUpdate(): self
    {
        $tmp = $this->transaction(function () {
            $campaign = Campaign::fillFromRequest($this->request, $this->model->id ?? null);
            $user_ids = $this->request->input('user_ids');

            if ($campaign->save()) {
                $campaign->refreshCoordinators($user_ids);
            }

            return $campaign;
        });

        if ($tmp) {
            $this->model = $tmp;
        }

        return $this;
    }

    public function bulkAssignUsers(): self
    {
        $this->transaction(function () {
            $current = UserCampaign::where('campaign_id', $this->model->id)->get();
            $current_ids = $current->pluck('user_id')->flip();

            if ($this->request->input('user_ids')) {
                foreach ($this->request->input('user_ids') as $user_id) {
                    if (!$current_ids->has($user_id)) {
                        $this->assignUser($user_id);
                    } else {
                        $current_ids->forget($user_id);
                    }
                }

                foreach ($current_ids as $user_id => $key) {
                    $this->unassignUser($user_id);
                }
            }
        });

        return $this;
    }

    public function assignUser($user_id): bool
    {
        $result = $this->transaction(function () use ($user_id) {
            $r = false;
            $exists = $this->model->user_campaigns()->where('user_id', $user_id)->exists();
            if (!$exists) {
                $r = $this->model->user_campaigns()->create([
                    'user_id' => $user_id,
                    'stage' => $this->model->setUserStage($user_id),
                    'manual' => $this->model->manual,
                    'active' => $this->model->draft ? 0 : 1,
                ]);
            }
            return $r;
        });

        return $result ? true : false;
    }

    public function unassignUser($user_id): bool
    {
        $result = $this->transaction(function () use ($user_id) {
            $record = $this->model->user_campaigns()->where('user_id', $user_id)->first();
            if ($record) {
                return $record->delete();
            }
            return true;
        });

        return $result ? true : false;
    }
}
