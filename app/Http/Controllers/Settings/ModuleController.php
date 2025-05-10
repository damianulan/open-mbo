<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Settings\MailSettings;
use App\Forms\Settings\SmtpForm;
use App\Settings\MBOSettings;
use App\Forms\Settings\MboForm;

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
    public function index(Request $request, ?string $module = null)
    {
        $modules = $this->getModules();
        if (is_null($module) || !array_key_exists($module, $modules)) {
            $module = 'users';
        }

        $mboModel = app(MBOSettings::class);
        return view('pages.settings.modules.index', [
            'modules' => $modules,
            'mod' => $modules[$module]['id'],
            'mboForm' => MboForm::definition($request, $mboModel),
            'nav' => $this->nav(),
        ]);
    }

    public function storeMbo(Request $request, MboForm $form, MBOSettings $settings)
    {
        $request = $form::reformatRequest($request);
        $form::validate($request);
        foreach ($request->all() as $key => $value) {
            $settings->$key = $value;
        }
        if ($settings->save()) {
            return redirect()->to(route('settings.modules.index', ['module' => 'mbo']))->with('success', __('alerts.settings.success.mail_update'));
        }
        return redirect()->to(route('settings.modules.index', ['module' => 'mbo']))->with('error', __('alerts.settings.error.mail_update'));;
    }
}
