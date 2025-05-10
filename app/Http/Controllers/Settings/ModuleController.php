<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Settings\MailSettings;
use App\Forms\Settings\SmtpForm;
use App\Settings\MBOSettings;

class ModuleController extends SettingsController
{

    public function getModules()
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        return view('pages.settings.modules.index', [
            'modules' => $this->getModules(),
            'nav' => $this->nav(),
        ]);
    }
}
