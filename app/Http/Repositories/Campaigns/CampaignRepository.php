<?php

namespace App\Http\Repositories\Campaigns;

use Illuminate\Http\Request;
use App\Http\Repositories\Repository;
use App\Models\MBO\Campaign;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CampaignRepository extends Repository
{
    public function upsert(): static
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
}
