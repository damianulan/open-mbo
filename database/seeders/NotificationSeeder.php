<?php

namespace Database\Seeders;

use App\Support\Notifications\Models\Notification;
use Illuminate\Database\Seeder;
use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Models\MBO\UserCampaign;
use App\Support\Notifications\NotificationContents;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::createOrUpdate('CAMPAIGN_ASSIGNED', [
            'resources' => [
                UserCampaign::class,
            ],
            'contents' => NotificationContents::boot('{% firstname %}, Przypisano Cię do kampanii {% campaign_name %}.'),
            'event' => UserCampaignAssigned::class,
            'system' => true,
            'email' => false,
        ]);
    }
}
