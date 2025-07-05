<?php

namespace App\Enums\Core;

use Lucent\Support\Enum;

class PermissionLib extends Enum
{
    // core
    public const TELESCOPE_VIEW = 'telescope-view';

    public const MAINTENANCE = 'maintenance';

    // global

    /**
     * When retrieving models, ignore contextual assignments.
     */
    public const MBO_ADMINISTRATION = 'mbo-administration';

    // users
    public const USERS_IMPERSONATE = 'users-impersonate';

    public const USERS_LIST = 'users-list';

    public const USERS_VIEW = 'users-view';

    public const USERS_CREATE = 'users-create';

    public const USERS_EDIT = 'users-edit';

    public const USERS_TEAMS = 'users-teams';

    public const USERS_DELETE = 'users-delete';

    public const USERS_RESTORE = 'users-restore';

    // settings
    public const SETTINGS_GENERAL = 'settings-general';

    public const SETTINGS_MODULES = 'settings-modules';

    public const SETTINGS_INTEGRATIONS = 'settings-integrations';

    public const SETTINGS_SERVER = 'settings-server';

    public const SETTINGS_LOGS = 'settings-logs';

    public const SETTINGS_USERS = 'settings-users';

    public const SETTINGS_ROLES = 'settings-roles';

    public const SETTINGS_ORGANIZATION = 'settings-organization';

    public const SETTINGS_NOTIFICATIONS = 'settings-notifications';

    public const SETTINGS_REPORTS = 'settings-reports';

    // management
    public const MBO_TEMPLATES = 'mbo-templates';

    public const MBO_CATEGORIES = 'mbo-categories';

    // reports
    public const REPORTS_VIEW = 'reports-view';

    // mbo

    /**
     * viewing always all objective templates
     */
    public const MBO_TEMPLATES_VIEW = 'mbo-templates-view';

    public const MBO_TEMPLATES_CREATE = 'mbo-templates-create';

    public const MBO_TEMPLATES_UPDATE = 'mbo-templates-update';

    public const MBO_TEMPLATES_DELETE = 'mbo-templates-delete';

    public const MBO_CATEGORIES_VIEW = 'mbo-categories-view';

    public const MBO_CATEGORIES_CREATE = 'mbo-categories-create';

    public const MBO_CATEGORIES_UPDATE = 'mbo-categories-update';

    public const MBO_CATEGORIES_DELETE = 'mbo-categories-delete';

    /**
     * Viewing always all campaigns
     */
    public const MBO_CAMPAIGN_VIEW = 'mbo-campaign-view';

    public const MBO_CAMPAIGN_CREATE = 'mbo-campaign-create';

    public const MBO_CAMPAIGN_UPDATE = 'mbo-campaign-update';

    public const MBO_CAMPAIGN_DELETE = 'mbo-campaign-delete';

    public const MBO_CAMPAIGN_TERMINATE = 'mbo-campaign-terminate';

    public const MBO_CAMPAIGN_CANCEL = 'mbo-campaign-cancel';

    public const MBO_CAMPAIGN_MANAGE_OBJECTIVES = 'mbo-campaign-manage-objectives';

    public const MBO_CAMPAIGN_MANAGE_USERS = 'mbo-campaign-manage-users';

    public const MBO_CAMPAIGN_MANAGE_MANUAL = 'mbo-campaign-manage-manual';

    public const MBO_OBJECTIVE_VIEW = 'mbo-objective-view';

    public const MBO_OBJECTIVE_CREATE = 'mbo-objective-create';

    public const MBO_OBJECTIVE_UPDATE = 'mbo-objective-update';

    public const MBO_OBJECTIVE_DELETE = 'mbo-objective-delete';

    public const MBO_OBJECTIVE_MILESTONES = 'mbo-objective-milestones';

    public const MBO_OBJECTIVE_REALIZATION = 'mbo-objective-realization';

    /**
     * roles and their permissions for core functionality, cannot be manipulated in-app.
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
     */
    public static function normal(): array
    {
        return [
            // global

            self::MBO_ADMINISTRATION => ['admins', 'admin_mbo'],

            // users
            self::USERS_IMPERSONATE => ['admins'],
            self::USERS_LIST => ['admins', 'admin_mbo', 'admin_hr', 'supervisor'], // and probably any other superior roles and team leader @TODO later
            self::USERS_VIEW => ['admins', 'admin_mbo', 'admin_hr', 'supervisor'], // and probably any other superior roles and team leader @TODO later
            self::USERS_CREATE => ['admins'],
            self::USERS_EDIT => ['admins', 'admin_hr'], // includes assigning assignable roles (not based on role context)
            self::USERS_TEAMS => ['admins', 'admin_hr'],
            self::USERS_DELETE => ['admins'],
            self::USERS_RESTORE => ['admins'],

            // settings
            self::SETTINGS_GENERAL => ['admins'],
            self::SETTINGS_MODULES => ['admins'],
            self::SETTINGS_INTEGRATIONS => ['admins'],
            self::SETTINGS_SERVER => ['admins'],
            self::SETTINGS_LOGS => ['admins'],
            self::SETTINGS_USERS => ['admins', 'admin_hr'],
            self::SETTINGS_ROLES => ['admins'], // role/permission manipulations
            self::SETTINGS_ORGANIZATION => ['admins'],
            self::SETTINGS_NOTIFICATIONS => ['admins'],
            self::SETTINGS_REPORTS => ['admins'],

            // management
            self::MBO_TEMPLATES => ['admins', 'admin_mbo', 'objective_coordinator'],
            self::MBO_CATEGORIES => ['admins', 'admin_mbo'],

            // reports
            self::REPORTS_VIEW => ['admins', 'admin_mbo', 'supervisor'], // and probably any other superior roles and team leader @TODO later

            // mbo
            self::MBO_TEMPLATES_VIEW => ['admins', 'admin_mbo', 'objective_coordinator'],
            self::MBO_TEMPLATES_CREATE => ['admins', 'admin_mbo', 'objective_coordinator'],
            self::MBO_TEMPLATES_UPDATE => ['admins', 'admin_mbo', 'objective_coordinator'],
            self::MBO_TEMPLATES_DELETE => ['admins', 'admin_mbo', 'objective_coordinator'],

            self::MBO_CATEGORIES_VIEW => ['admins', 'admin_mbo'],
            self::MBO_CATEGORIES_CREATE => ['admins', 'admin_mbo'],
            self::MBO_CATEGORIES_UPDATE => ['admins', 'admin_mbo'],
            self::MBO_CATEGORIES_DELETE => ['admins', 'admin_mbo'],

            self::MBO_CAMPAIGN_CREATE => ['admins', 'admin_mbo'],
            self::MBO_CAMPAIGN_VIEW => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_UPDATE => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_DELETE => ['admins', 'admin_mbo'],
            self::MBO_CAMPAIGN_TERMINATE => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_CANCEL => ['admins', 'admin_mbo'], // operation is not reversible -- keep it strict
            self::MBO_CAMPAIGN_MANAGE_OBJECTIVES => ['admins', 'admin_mbo', 'campaign_coordinator'], // adding/removing users and objectives to/from campaign.
            self::MBO_CAMPAIGN_MANAGE_USERS => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_MANAGE_MANUAL => ['admins', 'admin_mbo', 'campaign_coordinator'],

            self::MBO_OBJECTIVE_VIEW => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'],
            self::MBO_OBJECTIVE_CREATE => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator'],
            self::MBO_OBJECTIVE_UPDATE => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator'],
            self::MBO_OBJECTIVE_DELETE => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator'],
            self::MBO_OBJECTIVE_MILESTONES => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'],
            self::MBO_OBJECTIVE_REALIZATION => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'],
        ];
    }
}
