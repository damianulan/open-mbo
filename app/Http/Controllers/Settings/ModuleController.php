<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\MboForm;
use App\Forms\Settings\NotificationsForm;
use App\Forms\Settings\UsersForm;
use App\Settings\MboSettings;
use App\Settings\NotificationSettings;
use App\Settings\UserSettings;
use App\Support\Modules\ModuleManager;
use App\Warden\PermissionsLib;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModuleController extends SettingsController
{
    public function index(Request $request, ?string $module = null): View
    {
        if ($request->user()->cannot(PermissionsLib::SETTINGS_MODULES)) {
            unauthorized();
        }

        $this->addPageNav();

        $modules = ModuleManager::getModules();

        if (is_null($module) || ! array_key_exists($module, $modules)) {
            $module = 'users';
        }

        $userModel = app(UserSettings::class);
        $mboModel = app(MboSettings::class);
        $notificationModel = app(NotificationSettings::class);

        return view('pages.settings.modules.index', [
            'modules' => $modules,
            'mod' => $modules[$module]['id'],
            'usersForm' => UsersForm::bootWithAttributes($userModel->toArray())->getDefinition(),
            'mboForm' => MboForm::bootWithAttributes($mboModel->toArray())->getDefinition(),
            'notificationsForm' => NotificationsForm::bootWithAttributes($notificationModel->toArray())->getDefinition(),
        ]);
    }

    public function storeMbo(Request $request, MboForm $form, MboSettings $settings): RedirectResponse
    {
        $form->validate();

        foreach ($form->all() as $key => $value) {
            $settings->{$key} = $value;
        }

        if ($settings->save()) {
            return redirect()->route('settings.modules.index', ['module' => 'mbo'])->with('success', __('alerts.settings.success.update'));
        }

        return redirect()->route('settings.modules.index', ['module' => 'mbo'])->with('error', __('alerts.settings.error.update'));
    }

    public function storeUsers(Request $request, UsersForm $form, UserSettings $settings): RedirectResponse
    {
        $form->validate();

        foreach ($form->all() as $key => $value) {
            $settings->{$key} = $value;
        }

        if ($settings->save()) {
            return redirect()->route('settings.modules.index', ['module' => 'users'])->with('success', __('alerts.settings.success.update'));
        }

        return redirect()->route('settings.modules.index', ['module' => 'users'])->with('error', __('alerts.settings.error.update'));
    }

    public function storeNotifications(Request $request, NotificationsForm $form, NotificationSettings $settings): RedirectResponse
    {
        $form->validate();

        foreach ($form->all() as $key => $value) {
            $settings->{$key} = $value;
        }

        if ($settings->save()) {
            return redirect()->route('settings.modules.index', ['module' => 'notifications'])->with('success', __('alerts.settings.success.update'));
        }

        return redirect()->route('settings.modules.index', ['module' => 'notifications'])->with('error', __('alerts.settings.error.update'));
    }
}
