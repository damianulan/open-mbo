<?php

namespace App\Enums\MBO;

enum ObjectiveType: string
{
    // can be assigned to a specific user. Assigned to a campaign will be copied and distributed through all participants.
    case INDIVIDUAL = 'individual';

    // can be assigned only to a team leader / supervisor and cannot be cascaded down the organization structure.
    // assigned to a campaign will be distributed to all team leaders and supervisors.
    case TEAM       = 'team';

    // can be viewed by all users who have higher RBAC than "employee". They can be marked as completed only by admins and admin_mbo. --- TODO [coming soon]
    case GLOBAL     = 'global';

    public static function values()
    {
        $collection = array();
        foreach(self::cases() as $case){
            $collection[] = $case->value;
        }
        return $collection;
    }
}
