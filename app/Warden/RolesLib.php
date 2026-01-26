<?php

namespace App\Warden;

use Sentinel\Config\Warden\RoleWarden;

final class RolesLib extends RoleWarden
{
    public const ROOT = 'root';

    public const HELPDESK = 'support';

    public const ADMIN = 'admin';

    public const ADMIN_MBO = 'admin_mbo';

    public const ADMIN_HR = 'admin_hr';

    public const EMPLOYEE = 'employee';

    // non-assignable - context-required
    public const OBJECTIVE_COORDINATOR = 'objective_coordinator';

    public const CAMPAIGN_COORDINATOR = 'campaign_coordinator';

    public const DIRECTOR = 'director';

    public const MANAGER = 'manager';

    public const TEAM_LEADER = 'team_leader';

    public const SUPERVISOR = 'supervisor';

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
