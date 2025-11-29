<?php

namespace App\Warden;

use Sentinel\Config\Warden\PermissionWarden;

final class PermissionsLib extends PermissionWarden
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

    public const MBO_OBJECTIVE_EVALUATE = 'mbo-objective-evaluate';

    public const MBO_OBJECTIVE_MILESTONES = 'mbo-objective-milestones';

    public const MBO_OBJECTIVE_REALIZATION = 'mbo-objective-realization';

    public static function nonassignable(): array
    {
        return array(
            self::TELESCOPE_VIEW => array('root', 'support'),
            self::MAINTENANCE => array('root', 'support'),
        );
    }

    public static function assignable(): array
    {
        return array(
            // global

            self::MBO_ADMINISTRATION => array('admins', 'admin_mbo'),

            // users
            self::USERS_IMPERSONATE => array('admins'),
            self::USERS_LIST => array('admins', 'admin_mbo', 'admin_hr', 'supervisor'), // and probably any other superior roles and team leader @TODO later
            self::USERS_VIEW => array('admins', 'admin_mbo', 'admin_hr', 'supervisor'), // and probably any other superior roles and team leader @TODO later
            self::USERS_CREATE => array('admins'),
            self::USERS_EDIT => array('admins', 'admin_hr'), // includes assigning assignable roles (not based on role context)
            self::USERS_TEAMS => array('admins', 'admin_hr'),
            self::USERS_DELETE => array('admins'),
            self::USERS_RESTORE => array('admins'),

            // settings
            self::SETTINGS_GENERAL => array('admins'),
            self::SETTINGS_MODULES => array('admins'),
            self::SETTINGS_INTEGRATIONS => array('admins'),
            self::SETTINGS_SERVER => array('admins'),
            self::SETTINGS_LOGS => array('admins'),
            self::SETTINGS_USERS => array('admins', 'admin_hr'),
            self::SETTINGS_ROLES => array('admins'), // role/permission manipulations
            self::SETTINGS_ORGANIZATION => array('admins'),
            self::SETTINGS_NOTIFICATIONS => array('admins'),
            self::SETTINGS_REPORTS => array('admins'),

            // management
            self::MBO_TEMPLATES => array('admins', 'admin_mbo', 'objective_coordinator'),
            self::MBO_CATEGORIES => array('admins', 'admin_mbo'),

            // reports
            self::REPORTS_VIEW => array('admins', 'admin_mbo', 'supervisor'), // and probably any other superior roles and team leader @TODO later

            // mbo
            self::MBO_TEMPLATES_VIEW => array('admins', 'admin_mbo', 'objective_coordinator'),
            self::MBO_TEMPLATES_CREATE => array('admins', 'admin_mbo', 'objective_coordinator'),
            self::MBO_TEMPLATES_UPDATE => array('admins', 'admin_mbo', 'objective_coordinator'),
            self::MBO_TEMPLATES_DELETE => array('admins', 'admin_mbo', 'objective_coordinator'),

            self::MBO_CATEGORIES_VIEW => array('admins', 'admin_mbo'),
            self::MBO_CATEGORIES_CREATE => array('admins', 'admin_mbo'),
            self::MBO_CATEGORIES_UPDATE => array('admins', 'admin_mbo'),
            self::MBO_CATEGORIES_DELETE => array('admins', 'admin_mbo'),

            self::MBO_CAMPAIGN_CREATE => array('admins', 'admin_mbo'),
            self::MBO_CAMPAIGN_VIEW => array('admins', 'admin_mbo', 'campaign_coordinator'),
            self::MBO_CAMPAIGN_UPDATE => array('admins', 'admin_mbo', 'campaign_coordinator'),
            self::MBO_CAMPAIGN_DELETE => array('admins', 'admin_mbo'),
            self::MBO_CAMPAIGN_TERMINATE => array('admins', 'admin_mbo', 'campaign_coordinator'),
            self::MBO_CAMPAIGN_CANCEL => array('admins', 'admin_mbo'), // operation is not reversible -- keep it strict
            self::MBO_CAMPAIGN_MANAGE_OBJECTIVES => array('admins', 'admin_mbo', 'campaign_coordinator'), // adding/removing users and objectives to/from campaign.
            self::MBO_CAMPAIGN_MANAGE_USERS => array('admins', 'admin_mbo', 'campaign_coordinator'),
            self::MBO_CAMPAIGN_MANAGE_MANUAL => array('admins', 'admin_mbo', 'campaign_coordinator'),

            self::MBO_OBJECTIVE_VIEW => array('admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'),
            self::MBO_OBJECTIVE_CREATE => array('admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator'),
            self::MBO_OBJECTIVE_UPDATE => array('admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator'),
            self::MBO_OBJECTIVE_DELETE => array('admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator'),
            self::MBO_OBJECTIVE_EVALUATE => array('admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'),
            self::MBO_OBJECTIVE_MILESTONES => array('admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'),
            self::MBO_OBJECTIVE_REALIZATION => array('admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'),
        );
    }

    public static function labels(): array
    {
        return __('gates.permissions');
    }
}
