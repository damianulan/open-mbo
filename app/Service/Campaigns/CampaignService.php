<?php

namespace App\Service\Campaigns;

use Illuminate\Http\Request;
use App\Service\BaseService;
use App\Models\MBO\Campaign;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CampaignService extends BaseService
{
    public function createOrUpdate(): static
    {
        $this->transaction(function () {
            $campaign = Campaign::fillFromRequest($this->request, $this->id);
            $user_ids = $this->request->input('user_ids');

            if ($campaign->save()) {
                $campaign->refreshCoordinators($user_ids);
            }

            return $campaign;
        });
        return $this;
    }

    public function destroy(): static
    {
        return $this;
    }
}
