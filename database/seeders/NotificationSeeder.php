<?php

namespace Database\Seeders;

use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Events\MBO\Campaigns\UserCampaignUnassigned;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\NotificationContents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::createOrUpdate('CAMPAIGN_ASSIGNED', array(
            'contents' => NotificationContents::boot('{% firstname %}, Przypisano Cię do kampanii {% campaign_name %}.'),
            'event' => UserCampaignAssigned::class,
            'system' => true,
            'email' => false,
        ));

        Notification::createOrUpdate('CAMPAIGN_UNASSIGNED', array(
            'contents' => NotificationContents::boot('{% firstname %}, Wypisano Cię z kampanii {% campaign_name %}.'),
            'event' => UserCampaignUnassigned::class,
            'system' => true,
            'email' => false,
        ));
    }
}
