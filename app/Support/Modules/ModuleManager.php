<?php

namespace App\Support\Modules;

class ModuleManager
{
    public static function getModules()
    {
        return array(
            'users' => array(
                'id' => 'module-users-btn',
                'icon' => 'person-fill',
                'title' => 'Użytkownicy',
                'route' => null,
            ),
            'mbo' => array(
                'id' => 'module-mbo-btn',
                'icon' => 'bullseye',
                'title' => 'Moduł MBO',
                'route' => null,
            ),
            'reports' => array(
                'id' => 'module-reports-btn',
                'icon' => 'bar-chart-steps',
                'title' => 'Raporty',
                'route' => null,
            ),
            'notifications' => array(
                'id' => 'module-notifications-btn',
                'icon' => 'bell-fill',
                'title' => 'Powiadomienia',
                'route' => null,
            ),
        );
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
