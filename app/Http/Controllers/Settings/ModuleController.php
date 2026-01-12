<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\MboForm;
use App\Forms\Settings\NotificationsForm;
use App\Forms\Settings\UsersForm;
use App\Settings\MBOSettings;
use App\Settings\NotificationSettings;
use App\Settings\UserSettings;
use App\Support\Modules\ModuleManager;
use App\Warden\PermissionsLib;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ModuleController extends SettingsController
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request, ?string $module = null): Renderable
    {
        if ($request->user()->cannot(PermissionsLib::SETTINGS_MODULES)) {
            unauthorized();
        }
        $modules = ModuleManager::getModules();
        if (is_null($module) || ! array_key_exists($module, $modules)) {
            $module = 'users';
        }

        $userModel = app(UserSettings::class);
        $mboModel = app(MBOSettings::class);
        $notificationModel = app(NotificationSettings::class);

        return view('pages.settings.modules.index', array(
            'modules' => $modules,
            'mod' => $modules[$module]['id'],
            'usersForm' => UsersForm::bootWithAttributes($userModel->toArray())->getDefinition(),
            'mboForm' => MboForm::bootWithAttributes($mboModel->toArray())->getDefinition(),
            'notificationsForm' => NotificationsForm::bootWithAttributes($notificationModel->toArray())->getDefinition(),
            'nav' => $this->nav(),
        ));
    }

    public function storeMbo(Request $request, MboForm $form, MBOSettings $settings)
    {
        $form->validate();
        foreach ($form->all() as $key => $value) {
            $settings->{$key} = $value;
        }
        if ($settings->save()) {
            return redirect()->to(route('settings.modules.index', array('module' => 'mbo')))->with('success', __('alerts.settings.success.update'));
        }

        return redirect()->to(route('settings.modules.index', array('module' => 'mbo')))->with('error', __('alerts.settings.error.update'));
    }

    public function storeUsers(Request $request, UsersForm $form, UserSettings $settings)
    {
        $form->validate();
        foreach ($form->all() as $key => $value) {
            $settings->{$key} = $value;
        }
        if ($settings->save()) {
            return redirect()->to(route('settings.modules.index', array('module' => 'users')))->with('success', __('alerts.settings.success.update'));
        }

        return redirect()->to(route('settings.modules.index', array('module' => 'users')))->with('error', __('alerts.settings.error.update'));
    }

    public function storeNotifications(Request $request, NotificationsForm $form, NotificationSettings $settings)
    {
        $form->validate();
        foreach ($form->all() as $key => $value) {
            $settings->{$key} = $value;
        }
        if ($settings->save()) {
            return redirect()->to(route('settings.modules.index', array('module' => 'notifications')))->with('success', __('alerts.settings.success.update'));
        }

        return redirect()->to(route('settings.modules.index', array('module' => 'notifications')))->with('error', __('alerts.settings.error.update'));
    }
}
