<?php

namespace App\Http\Controllers\Settings;

use App\Forms\Settings\GeneralForm;
use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use App\Facades\Page\MenuBuilder;
use App\Facades\Page\Bars\MenubarMenu;
use App\Facades\Page\Bars\MenuItem;

class SettingsController extends Controller
{
    protected MenubarMenu $nav;

    public function __construct()
    {
        $this->nav = MenuBuilder::bootMenubar('settings', [
            MenuItem::make('general')
                    ->setTitle(__('menus.settings.general.index'))
                    ->setRoute('settings.general.index'),
            MenuItem::make('modules')
                    ->setTitle(__('menus.settings.modules.index'))
                    ->setRoute('settings.modules.index'),
            MenuItem::make('integrations')
                    ->setTitle(__('menus.settings.integrations.index'))
                    ->setRoute('settings.integrations.index'),
            MenuItem::make('server')
                    ->setTitle(__('menus.settings.server.index'))
                    ->setRoute('settings.server.index'),
            MenuItem::make('logs')
                    ->setTitle(__('menus.settings.logs.index'))
                    ->setRoute('settings.logs.index'),
        ]);
    }
}
