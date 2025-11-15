<?php

namespace App\Notifications\Resources;

use App\Models\MBO\UserCampaign;
use App\Support\Notifications\Contracts\NotificationResource;

class UserCampaignResource extends NotificationResource
{
    public function __construct(UserCampaign $userCampaign)
    {
        parent::__construct($userCampaign);
    }

    public function datas(): array
    {
        return [
            'campaign_name' => $this->model->campaign->name,
        ];
    }

    public static function descriptions(): array
    {
        return [
            'campaign_name' => 'Campaign name',
        ];
    }
}
