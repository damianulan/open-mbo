<?php

namespace App\Notifications\Resources;

use App\Models\MBO\UserCampaign;
use App\Support\Notifications\Contracts\NotificationResource;

class UserCampaignResource extends NotificationResource
{
    public function __construct(protected UserCampaign $userCampaign) {}

    public function datas(): array
    {
        return [
            'campaign_name' => $this->userCampaign->campaign->name,
        ];
    }
}
