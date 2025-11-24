<?php

namespace Database\Seeders;

use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Events\MBO\Campaigns\UserCampaignUnassigned;
use App\Events\MBO\Objectives\UserObjectiveAssigned;
use App\Events\MBO\Objectives\UserObjectiveFailed;
use App\Events\MBO\Objectives\UserObjectivePassed;
use App\Events\MBO\Objectives\UserObjectiveUnassigned;
use App\Support\Notifications\Models\Notification;
use App\Support\Notifications\NotificationContents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::createOrUpdate('CAMPAIGN_ASSIGNED', [
            'contents' => NotificationContents::boot('{% firstname %}, Przypisano Cię do kampanii {% campaign_name %}.'),
            'event' => UserCampaignAssigned::class,
            'system' => true,
            'email' => false,
        ]);

        Notification::createOrUpdate('CAMPAIGN_UNASSIGNED', [
            'contents' => NotificationContents::boot('{% firstname %}, Wypisano Cię z kampanii {% campaign_name %}.'),
            'event' => UserCampaignUnassigned::class,
            'system' => true,
            'email' => false,
        ]);

        Notification::createOrUpdate('OBJECTIVE_ASSIGNED', [
            'contents' => NotificationContents::boot('{% firstname %}, Przypisano ci nowy cel do realizacji {% objective_name %}.'),
            'event' => UserObjectiveAssigned::class,
            'system' => true,
            'email' => false,
        ]);

        Notification::createOrUpdate('OBJECTIVE_UNASSIGNED', [
            'contents' => NotificationContents::boot('{% firstname %}, Wypisano Cię z realizacji celu {% objective_name %}.'),
            'event' => UserObjectiveUnassigned::class,
            'system' => true,
            'email' => false,
        ]);

        Notification::createOrUpdate('OBJECTIVE_PASSED', [
            'contents' => NotificationContents::boot('{% firstname %}, przypisany do Ciebie cel {% objective_name %} został oznaczony jako zaliczony.'),
            'event' => UserObjectivePassed::class,
            'system' => true,
            'email' => false,
        ]);

        Notification::createOrUpdate('OBJECTIVE_FAILED', [
            'contents' => NotificationContents::boot('{% firstname %}, przypisany do Ciebie cel {% objective_name %} został oznaczony jako niezaliczony.'),
            'event' => UserObjectiveFailed::class,
            'system' => true,
            'email' => false,
        ]);
    }
}
