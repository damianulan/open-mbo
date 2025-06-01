<?php

namespace App\Support\Modules;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Notifications\Notification;

class ModuleManager
{

    public static function getModules()
    {
        return [
            'users' => [
                'id' => 'module-users-btn',
                'icon' => 'person-fill',
                'title' => 'Użytkownicy',
                'route' => null,
            ],
            'mbo' => [
                'id' => 'module-mbo-btn',
                'icon' => 'bullseye',
                'title' => 'Moduł MBO',
                'route' => null,
            ],
            'reports' => [
                'id' => 'module-reports-btn',
                'icon' => 'bar-chart-steps',
                'title' => 'Raporty',
                'route' => null,
            ],
            'notifications' => [
                'id' => 'module-notifications-btn',
                'icon' => 'bell-fill',
                'title' => 'Powiadomienia',
                'route' => null,
            ],
        ];
    }

    /**
     * Checks if given module is exists and is active/enabled.
     *
     * @param string $module
     * @return bool
     */
    public static function check(string $module)
    {
        $modules = array_keys(self::getModules());
        $verified = in_array($module, $modules);
        $result = true;
        if (!$verified) {
            $result = false;
        }

        switch ($module) {
            case 'mbo':
                if (!setting('mbo.enabled')) {
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
