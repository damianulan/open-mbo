<?php

namespace App\Enums\Core;

use FormForge\Enums\Enum;

class PermissionLib extends Enum
{
    // core
    public const TELESCOPE_VIEW = 'telescope-view';
    public const MAINTENANCE = 'maintenance';

    // users
    public const USERS_IMPERSONATE = 'users-impersonate';
    public const USERS_LIST = 'users-list';
    public const USERS_VIEW = 'users-view';
    public const USERS_CREATE = 'users-create';
    public const USERS_EDIT = 'users-edit';
    public const USERS_TEAMS = 'users-teams';
    public const USERS_DELETE = 'users-delete';
    public const USERS_RESTORE = 'users-restore';
    public const USERS_VIEW_ALL = 'users-view-all';

    // settings
    public const SETTINGS_GENERAL = 'settings-general';
    public const SETTINGS_MODULES = 'settings-modules';
    public const SETTINGS_INTEGRATIONS = 'settings-integrations';
    public const SETTINGS_SERVER = 'settings-server';
    public const SETTINGS_LOGS = 'settings-logs';

    // management
    public const MANAGEMENT_MBO_TEMPLATES = 'management-mbo-templates';
    public const MANAGEMENT_MBO_CATEGORIES = 'management-mbo-categories';
    public const MANAGEMENT_USERS = 'management-users';
    public const MANAGEMENT_ROLES = 'management-roles';
    public const MANAGEMENT_STRUCTURE = 'management-structure';
    public const MANAGEMENT_NOTIFICATIONS = 'management-notifications';
    public const MANAGEMENT_REPORTS = 'management-reports';
    public const MANAGEMENT_RECOVERY = 'management-recovery';

    // reports
    public const REPORTS_VIEW = 'reports-view';

    // mbo

    /**
     * viewing all mbo-related data - no direct access distinction
     */
    public const MBO_ADMINISTRATION = 'mbo-administration';

    public const MBO_CAMPAIGN_VIEW = 'mbo-campaign-view';

    public const MBO_CAMPAIGN_CREATE = 'mbo-campaign-create';
    public const MBO_CAMPAIGN_UPDATE = 'mbo-campaign-update';
    public const MBO_CAMPAIGN_DELETE = 'mbo-campaign-delete';
    public const MBO_CAMPAIGN_MANAGE = 'mbo-campaign-manage';

    public const MBO_OBJECTIVE_CREATE = 'mbo-objective-create';
    public const MBO_OBJECTIVE_VIEW = 'mbo-objective-view';
    public const MBO_OBJECTIVE_UPDATE = 'mbo-objective-update';
    public const MBO_OBJECTIVE_DELETE = 'mbo-objective-delete';
    public const MBO_OBJECTIVE_MILESTONES = 'mbo-objective-milestones';
    public const MBO_OBJECTIVE_REALIZATION = 'mbo-objective-realization';
    public const MBO_VIEW_ALL_OBJECTIVES = 'mbo-view-all-objectives';

    /**
     * roles and their permissions for core functionality, cannot be manipulated in-app.
     *
     * @return array
     */
    public static function core(): array
    {
        return [
            self::TELESCOPE_VIEW => ['root', 'support'],
            self::MAINTENANCE => ['root', 'support'],
        ];
    }

    /**
     * roles and their permissions for common use, can be manipulated by admins in settings.
     *
     * @return array
     */
    public static function normal(): array
    {
        return [
            // users
            self::USERS_IMPERSONATE => ['admins'],
            self::USERS_LIST => ['admins', 'admin_mbo', 'admin_hr', 'supervisor'], // and probably any other superior roles and team leader @TODO later
            self::USERS_VIEW => ['admins', 'admin_mbo', 'admin_hr', 'supervisor'], // and probably any other superior roles and team leader @TODO later
            self::USERS_CREATE => ['admins'],
            self::USERS_EDIT => ['admins', 'admin_hr'], // includes assigning assignable roles (not based on role context)
            self::USERS_TEAMS => ['admins', 'admin_hr'],
            self::USERS_DELETE => ['admins'],
            self::USERS_RESTORE => ['admins'],
            self::USERS_VIEW_ALL => ['*'],

            // settings
            self::SETTINGS_GENERAL => ['admins'],
            self::SETTINGS_MODULES => ['admins'],
            self::SETTINGS_INTEGRATIONS => ['admins'],
            self::SETTINGS_SERVER => ['admins'],
            self::SETTINGS_LOGS => ['admins'],

            // management
            self::MANAGEMENT_MBO_TEMPLATES => ['admins', 'admin_mbo', 'objective_coordinator'],
            self::MANAGEMENT_MBO_CATEGORIES => ['admins', 'admin_mbo'],
            self::MANAGEMENT_USERS => ['admins', 'admin_hr'],
            self::MANAGEMENT_ROLES => ['admins'], // role/permission manipulations
            self::MANAGEMENT_STRUCTURE => ['admins'],
            self::MANAGEMENT_NOTIFICATIONS => ['admins'],
            self::MANAGEMENT_REPORTS => ['admins'],
            self::MANAGEMENT_RECOVERY => ['admins'],

            // reports
            self::REPORTS_VIEW => ['admins', 'admin_mbo', 'supervisor'], // and probably any other superior roles and team leader @TODO later

            // mbo
            self::MBO_ADMINISTRATION => ['admins', 'admin_mbo'],
            self::MBO_CAMPAIGN_CREATE => ['admins', 'admin_mbo'],
            self::MBO_CAMPAIGN_VIEW => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_UPDATE => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_DELETE => ['admins', 'admin_mbo'],
            self::MBO_CAMPAIGN_MANAGE => ['admins', 'admin_mbo', 'campaign_coordinator'], // adding/removing users and objectives to/from campaign.

            self::MBO_OBJECTIVE_CREATE => ['admins', 'admin_mbo', 'objective_coordinator'],
            self::MBO_OBJECTIVE_VIEW => ['admins', 'admin_mbo', 'objective_coordinator'],
            self::MBO_OBJECTIVE_UPDATE => ['admins', 'admin_mbo', 'objective_coordinator'],
            self::MBO_OBJECTIVE_DELETE => ['admins', 'admin_mbo'],
            self::MBO_OBJECTIVE_MILESTONES => ['admins', 'admin_mbo', 'objective_coordinator', 'supervisor'],
            self::MBO_OBJECTIVE_REALIZATION => ['admins', 'admin_mbo', 'objective_coordinator', 'supervisor'],
            self::MBO_VIEW_ALL_OBJECTIVES => ['*'],
        ];
    }
}
