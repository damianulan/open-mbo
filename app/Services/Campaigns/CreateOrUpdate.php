<?php

namespace App\Services\Campaigns;

use App\Models\MBO\Campaign;
use Lucent\Services\Service;

class CreateOrUpdate extends Service
{
    public function handle(): Campaign
    {
        $campaign = Campaign::fillFromRequest($this->request(), $this->campaign->id ?? null);
        $user_ids = $this->request()->input('user_ids');

        if ($campaign->save()) {
            $campaign->refreshCoordinators($user_ids);
            $this->campaign = $campaign;
        }

        return $campaign;
    }
}
