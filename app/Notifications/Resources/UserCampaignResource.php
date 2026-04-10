<?php

namespace App\Notifications\Resources;

use App\Models\Mbo\UserCampaign;
use App\Support\Notifications\Contracts\NotificationResource;

class UserCampaignResource extends NotificationResource
{
    public function __construct(UserCampaign $userCampaign)
    {
        parent::__construct($userCampaign);
    }

    public static function descriptions(): array
    {
        return [
            'campaign_name' => 'Campaign name',
        ];
    }

    public function datas(): array
    {
        $this->model->loadMissing('campaign');

        return [
            'campaign_name' => $this->model->campaign->name,
        ];
    }
}
