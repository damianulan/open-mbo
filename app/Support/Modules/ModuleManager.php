<?php

namespace App\Support\Modules;

class ModuleManager
{
    public static function getModules()
    {
        return [
            'users' => [
                'id' => 'module-users-btn',
                'icon' => 'person-fill',
                'title' => __('menus.users.index'),
                'route' => null,
            ],
            'mbo' => [
                'id' => 'module-mbo-btn',
                'icon' => 'bullseye',
                'title' => __('forms.settings.mbo.index'),
                'route' => null,
            ],
            'reports' => [
                'id' => 'module-reports-btn',
                'icon' => 'bar-chart-steps',
                'title' => __('menus.reports.index'),
                'route' => null,
            ],
            'notifications' => [
                'id' => 'module-notifications-btn',
                'icon' => 'bell-fill',
                'title' => __('menus.settings.notifications.index'),
                'route' => null,
            ],
        ];
    }

    /**
     * Checks if given module is exists and is active/enabled.
     *
     * @return bool
     */
    public static function check(string $module)
    {
        $modules = array_keys(self::getModules());
        $verified = in_array($module, $modules);
        $result = true;
        if ( ! $verified) {
            $result = false;
        }

        switch ($module) {
            case 'mbo':
                if ( ! settings('mbo.enabled')) {
                    $result = false;
                }
                break;

            default:
                $result = true;
                break;
        }

        return $result;
    }
}
