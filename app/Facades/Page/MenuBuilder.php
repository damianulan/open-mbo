<?php

namespace App\Facades\Page;

use App\Facades\Page\Bars\SidebarMenu;
use App\Facades\Page\Bars\MenubarMenu;
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
            MenuItem::make('campaign')
                ->setTitle(__('menus.campaigns.index'))
                ->setIcon('bullseye')
                ->setRoute('campaigns.index'),
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
                ->setIcon('diagram-3-fill')
                ->setRoute('management.mbo.objectives.index'),
            MenuItem::make('settings')
                ->setTitle(__('menus.settings.index'))
                ->setIcon('gear-fill')
                ->permission('settings-*')
                ->setRoute('settings.general.index'),
        ]);

        return $sidebar;
    }

    public static function bootMenubar(string $id, array $items): MenubarMenu
    {
        return MenubarMenu::boot($id, $items);
    }
}
