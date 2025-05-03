<?php

namespace App\Enums\Core;

use FormForge\Enums\Enum;

class SystemRolesLib extends Enum
{

    const ROOT = 'root';
    const HELPDESK = 'support';
    const ADMIN = 'admin';
    const ADMIN_MBO = 'admin_mbo';
    const EMPLOYEE = 'employee';

    // non-assignable - context-required
    const OBJECTIVE_COORDINATOR = 'objective_coordinator';
    const CAMPAIGN_COORDINATOR = 'campaign_coordinator';

    const DIRECTOR = 'director';
    const MANAGER = 'manager';
    const TEAM_LEADER = 'team_leader';
    const SUPERVISOR = 'supervisor';
}
