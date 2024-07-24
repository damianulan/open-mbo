<?php

namespace App\Facades\Page;

use App\Facades\Page\Bars\SidebarMenu;
use App\Facades\Page\Bars\MenuItem;

class MenuBuilder
{

    public static function bootSidebar(string $sitename): SidebarMenu
    {
        $sidebar = SidebarMenu::boot($sitename, [
            MenuItem::make('dashboard')
                    ->setTitle(__('menus.dashboard'))
                    ->setIcon('grid-fill')
                    ->setRoute('dashboard'),
            MenuItem::make('objectives')
                    ->setTitle(__('menus.my_objectives.index'))
                    ->setIcon('clipboard-check-fill')
                    ->setRoute('my-objectives.index'),
            MenuItem::make('forms')
                    ->setTitle(__('menus.forms.index'))
                    ->setIcon('ui-radios')
                    ->setRoute('forms.index'),
            MenuItem::make('reports')
                    ->setTitle(__('menus.reports.index'))
                    ->setIcon('bar-chart-steps')
                    ->setRoute('reports.index'),
            MenuItem::make('users')
                    ->setTitle(__('menus.users.index'))
                    ->setIcon('person-fill')
                    ->setRoute('users.index'),
            MenuItem::make('management')
                    ->setTitle(__('menus.management.index'))
                    ->setIcon('layers-half')
                    ->setRoute('management.objectives.index'),
            MenuItem::make('settings')
                    ->setTitle(__('menus.settings.index'))
                    ->setIcon('ui-radios-grid')
                    ->setRoute('settings.index'),
        ]);

        return $sidebar;
    }

}
