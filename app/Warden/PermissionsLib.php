<?php

namespace App\Warden;

use Sentinel\Config\Warden\PermissionWarden;

final class PermissionsLib extends PermissionWarden
{
    public const string TELESCOPE_VIEW = 'telescope-view';

    public const string MAINTENANCE = 'maintenance';

    public const string MBO_ADMINISTRATION = 'mbo-administration';

    public const string USERS_IMPERSONATE = 'users-impersonate';

    public const string USERS_LIST = 'users-list';

    public const string USERS_VIEW = 'users-view';

    public const string USERS_PREVIEW = 'users-preview';

    public const string USERS_VIEW_DELETED = 'users-view-deleted';

    public const string USERS_CREATE = 'users-create';

    public const string USERS_EDIT = 'users-edit';

    public const string USERS_EMPLOYMENTS_MANAGE = 'users-employments-manage';

    public const string USERS_TEAMS = 'users-teams';

    public const string USERS_DELETE = 'users-delete';

    public const string USERS_RESTORE = 'users-restore';

    public const string USERS_BLOCK = 'users-block';

    public const string USERS_PASSWORD_RESET = 'users-password-reset';

    public const string SETTINGS_GENERAL = 'settings-general';

    public const string SETTINGS_MODULES = 'settings-modules';

    public const string SETTINGS_INTEGRATIONS = 'settings-integrations';

    public const string SETTINGS_SERVER = 'settings-server';

    public const string SETTINGS_LOGS = 'settings-logs';

    public const string SETTINGS_USERS = 'settings-users';

    public const string SETTINGS_ROLES = 'settings-roles';

    public const string SETTINGS_ORGANIZATION = 'settings-organization';

    public const string SETTINGS_NOTIFICATIONS = 'settings-notifications';

    public const string SETTINGS_REPORTS = 'settings-reports';

    public const string MBO_TEMPLATES = 'mbo-templates';

    public const string MBO_CATEGORIES = 'mbo-categories';

    public const string REPORTS_VIEW = 'reports-view';

    public const string MBO_TEMPLATES_VIEW = 'mbo-templates-view';

    public const string MBO_TEMPLATES_CREATE = 'mbo-templates-create';

    public const string MBO_TEMPLATES_UPDATE = 'mbo-templates-update';

    public const string MBO_TEMPLATES_DELETE = 'mbo-templates-delete';

    public const string MBO_CATEGORIES_VIEW = 'mbo-categories-view';

    public const string MBO_CATEGORIES_CREATE = 'mbo-categories-create';

    public const string MBO_CATEGORIES_UPDATE = 'mbo-categories-update';

    public const string MBO_CATEGORIES_DELETE = 'mbo-categories-delete';

    public const string MBO_CAMPAIGN_VIEW = 'mbo-campaign-view';

    public const string MBO_CAMPAIGN_PREVIEW = 'mbo-campaign-preview';

    public const string MBO_CAMPAIGN_CREATE = 'mbo-campaign-create';

    public const string MBO_CAMPAIGN_UPDATE = 'mbo-campaign-update';

    public const string MBO_CAMPAIGN_DELETE = 'mbo-campaign-delete';

    public const string MBO_CAMPAIGN_TERMINATE = 'mbo-campaign-terminate';

    public const string MBO_CAMPAIGN_CANCEL = 'mbo-campaign-cancel';

    public const string MBO_CAMPAIGN_MANAGE_OBJECTIVES = 'mbo-campaign-manage-objectives';

    public const string MBO_CAMPAIGN_MANAGE_USERS = 'mbo-campaign-manage-users';

    public const string MBO_CAMPAIGN_MANAGE_MANUAL = 'mbo-campaign-manage-manual';

    public const string MBO_OBJECTIVE_VIEW = 'mbo-objective-view';

    public const string MBO_OBJECTIVE_CREATE = 'mbo-objective-create';

    public const string MBO_OBJECTIVE_UPDATE = 'mbo-objective-update';

    public const string MBO_OBJECTIVE_DELETE = 'mbo-objective-delete';

    public const string MBO_OBJECTIVE_EVALUATE = 'mbo-objective-evaluate';

    public const string MBO_OBJECTIVE_MILESTONES = 'mbo-objective-milestones';

    public const string MBO_OBJECTIVE_REALIZATION = 'mbo-objective-realization';

    public static function nonassignable(): array
    {
        return [
            self::TELESCOPE_VIEW => ['root', 'support'],
            self::MAINTENANCE => ['root', 'support'],
        ];
    }

    public static function assignable(): array
    {
        return [
            self::MBO_ADMINISTRATION => ['admins', 'admin_mbo'],

            self::USERS_IMPERSONATE => ['admins'],
            self::USERS_LIST => ['admins', 'admin_mbo', 'admin_hr', 'supervisor'], // and probably any other superior roles and team leader @TODO later
            self::USERS_VIEW => ['admins', 'admin_mbo', 'admin_hr', 'supervisor'], // and probably any other superior roles and team leader @TODO later
            self::USERS_PREVIEW => ['*'],
            self::USERS_VIEW_DELETED => ['admins'],
            self::USERS_EMPLOYMENTS_MANAGE => ['admins', 'admin_hr'],
            self::USERS_CREATE => ['admins'],
            self::USERS_EDIT => ['admins', 'admin_hr'],
            self::USERS_TEAMS => ['admins', 'admin_hr'],
            self::USERS_DELETE => ['admins'],
            self::USERS_RESTORE => ['admins'],
            self::USERS_BLOCK => ['admins', 'admin_hr'],
            self::USERS_PASSWORD_RESET => ['admins', 'admin_hr', 'supervisor'],

            self::SETTINGS_GENERAL => ['admins'],
            self::SETTINGS_MODULES => ['admins'],
            self::SETTINGS_INTEGRATIONS => ['admins'],
            self::SETTINGS_SERVER => ['admins'],
            self::SETTINGS_LOGS => ['admins'],
            self::SETTINGS_USERS => ['admins', 'admin_hr'],
            self::SETTINGS_ROLES => ['admins'],
            self::SETTINGS_ORGANIZATION => ['admins'],
            self::SETTINGS_NOTIFICATIONS => ['admins'],
            self::SETTINGS_REPORTS => ['admins'],

            self::MBO_TEMPLATES => ['admins', 'admin_mbo', 'objective_coordinator'],
            self::MBO_CATEGORIES => ['admins', 'admin_mbo'],

            self::REPORTS_VIEW => ['admins', 'admin_mbo', 'admin_hr', 'supervisor'], // and probably any other superior roles and team leader @TODO later

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
            self::MBO_CAMPAIGN_PREVIEW => ['admins', 'admin_mbo'],
            self::MBO_CAMPAIGN_UPDATE => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_DELETE => ['admins', 'admin_mbo'],
            self::MBO_CAMPAIGN_TERMINATE => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_CANCEL => ['admins', 'admin_mbo'],
            self::MBO_CAMPAIGN_MANAGE_OBJECTIVES => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_MANAGE_USERS => ['admins', 'admin_mbo', 'campaign_coordinator'],
            self::MBO_CAMPAIGN_MANAGE_MANUAL => ['admins', 'admin_mbo', 'campaign_coordinator'],

            self::MBO_OBJECTIVE_VIEW => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'],
            self::MBO_OBJECTIVE_CREATE => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator'],
            self::MBO_OBJECTIVE_UPDATE => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator'],
            self::MBO_OBJECTIVE_DELETE => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator'],
            self::MBO_OBJECTIVE_EVALUATE => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'],
            self::MBO_OBJECTIVE_MILESTONES => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'],
            self::MBO_OBJECTIVE_REALIZATION => ['admins', 'admin_mbo', 'objective_coordinator', 'campaign_coordinator', 'supervisor'],
        ];
    }

    public static function labels(): array
    {
        return __('gates.permissions');
    }
}
