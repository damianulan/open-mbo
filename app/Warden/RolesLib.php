<?php

namespace App\Warden;

use Sentinel\Config\Warden\RoleWarden;

final class RolesLib extends RoleWarden
{
    const ROOT = 'root';

    const HELPDESK = 'support';

    const ADMIN = 'admin';

    const ADMIN_MBO = 'admin_mbo';

    const ADMIN_HR = 'admin_hr';

    const EMPLOYEE = 'employee';

    // non-assignable - context-required
    const OBJECTIVE_COORDINATOR = 'objective_coordinator';

    const CAMPAIGN_COORDINATOR = 'campaign_coordinator';

    const DIRECTOR = 'director';

    const MANAGER = 'manager';

    const TEAM_LEADER = 'team_leader';

    const SUPERVISOR = 'supervisor';

    public static function assignable(): array
    {
        return [
            self::EMPLOYEE,
            self::ADMIN,
            self::ADMIN_MBO,
            self::ADMIN_HR,
        ];
    }

    public static function admins(): array
    {
        return [
            self::ADMIN,
            self::ROOT,
            self::HELPDESK,
        ];
    }

    public static function labels(): array
    {
        return __('gates.roles');
    }
}
