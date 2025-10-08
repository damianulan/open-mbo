<?php

namespace App\Notifications\Resources;

use App\Models\MBO\UserCampaign;
use App\Support\Notifications\Contracts\NotificationResource;

class UserCampaignResource extends NotificationResource
{
    public function __construct(protected UserCampaign $userCampaign)
    {
        parent::__construct($userCampaign);
    }

    public function datas(): array
    {
        return [
            'campaign_name' => $this->userCampaign->campaign->name,
        ];
    }

    public function descriptions(): array
    {
        return [
            'campaign_name' => 'Campaign name',
        ];
    }
}
