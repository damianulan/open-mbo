<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\MboForm;
use App\Forms\Settings\NotificationsForm;
use App\Forms\Settings\UsersForm;
use App\Settings\MBOSettings;
use App\Settings\NotificationSettings;
use App\Settings\UserSettings;
use App\Support\Modules\ModuleManager;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ModuleController extends SettingsController
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(Request $request, ?string $module = null)
    {
        $modules = ModuleManager::getModules();
        if (is_null($module) || ! array_key_exists($module, $modules)) {
            $module = 'users';
        }

        $userModel = app(UserSettings::class);
        $mboModel = app(MBOSettings::class);
        $notificationModel = app(NotificationSettings::class);

        return view('pages.settings.modules.index', [
            'modules' => $modules,
            'mod' => $modules[$module]['id'],
            'usersForm' => UsersForm::definition($request, $userModel),
            'mboForm' => MboForm::definition($request, $mboModel),
            'notificationsForm' => NotificationsForm::definition($request, $notificationModel),
            'nav' => $this->nav(),
        ]);
    }

    public function storeMbo(Request $request, MboForm $form, MBOSettings $settings)
    {
        $request = $form::reformatRequest($request);
        $form::validate($request);
        foreach ($request->all() as $key => $value) {
            $settings->{$key} = $value;
        }
        if ($settings->save()) {
            return redirect()->to(route('settings.modules.index', ['module' => 'mbo']))->with('success', __('alerts.settings.success.update'));
        }

        return redirect()->to(route('settings.modules.index', ['module' => 'mbo']))->with('error', __('alerts.settings.error.update'));
    }


    public function storeUsers(Request $request, UsersForm $form, UserSettings $settings)
    {
        $request = $form::reformatRequest($request);
        $form::validate($request);
        foreach ($request->all() as $key => $value) {
            $settings->{$key} = $value;
        }
        if ($settings->save()) {
            return redirect()->to(route('settings.modules.index', ['module' => 'users']))->with('success', __('alerts.settings.success.update'));
        }

        return redirect()->to(route('settings.modules.index', ['module' => 'users']))->with('error', __('alerts.settings.error.update'));
    }

    public function storeNotifications(Request $request, NotificationsForm $form, NotificationSettings $settings)
    {
        $request = $form::reformatRequest($request);
        $form::validate($request);
        foreach ($request->all() as $key => $value) {
            $settings->{$key} = $value;
        }
        if ($settings->save()) {
            return redirect()->to(route('settings.modules.index', ['module' => 'notifications']))->with('success', __('alerts.settings.success.update'));
        }

        return redirect()->to(route('settings.modules.index', ['module' => 'notifications']))->with('error', __('alerts.settings.error.update'));
    }
}
