<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\AppController;
use Illuminate\Http\Request;
use App\Facades\Page\MenuBuilder;
use App\Facades\Page\Bars\MenubarMenu;
use App\Facades\Page\Bars\MenuItem;

class ManagementController extends AppController
{
    protected MenubarMenu $nav;

    public function nav(): MenubarMenu
    {
        return MenuBuilder::bootMenubar('management', [
            MenuItem::make('objectives')
                ->setTitle(__('menus.management.mbo.objectives.index'))
                ->setRoute('management.mbo.objectives.index'),
            MenuItem::make('categories')
                ->setTitle(__('menus.management.mbo.categories.index'))
                ->setRoute('management.mbo.categories.index'),
            MenuItem::make('users')
                ->setTitle(__('menus.management.users.index'))
                ->setRoute('management.users.index'),
            MenuItem::make('organization')
                ->setTitle(__('menus.management.organization.index'))
                ->setRoute('management.organization.index'),
            MenuItem::make('notifications')
                ->setTitle(__('menus.notifications.index'))
                ->setRoute('management.notifications.index'),
            // MenuItem::make('reports')
            //     ->setTitle(__('menus.reports.index'))
            //     ->setRoute('management.reports.index'),
        ]);
    }
}
