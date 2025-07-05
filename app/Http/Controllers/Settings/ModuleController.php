<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\MboForm;
use App\Settings\MBOSettings;
use App\Support\Modules\ModuleManager;
use Illuminate\Http\Request;

class ModuleController extends SettingsController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, ?string $module = null)
    {
        $modules = ModuleManager::getModules();
        if (is_null($module) || ! array_key_exists($module, $modules)) {
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
            return redirect()->to(route('settings.modules.index', ['module' => 'mbo']))->with('success', __('alerts.settings.success.mbo_update'));
        }

        return redirect()->to(route('settings.modules.index', ['module' => 'mbo']))->with('error', __('alerts.settings.error.mbo_update'));
    }
}
