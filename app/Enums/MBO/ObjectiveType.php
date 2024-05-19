<?php

namespace App\Enums\MBO;

enum ObjectiveType: string
{
    // can be assigned to a specific user. Assigned to a campaign will be copied and distributed through all participants.
    case INDIVIDUAL = 'individual';

    // can be assigned only to a team leader / supervisor and cannot be cascaded down the organization structure.
    // assigned to a campaign will be distributed to all team leaders and supervisors.
    case TEAM       = 'team';
}
