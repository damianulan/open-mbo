<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facades\Page\MenuBuilder;
use App\Facades\Page\Bars\MenubarMenu;
use App\Facades\Page\Bars\MenuItem;

class ManagementController extends Controller
{
    protected MenubarMenu $nav;

    public function __construct()
    {
        $this->nav = MenuBuilder::bootMenubar('management', [
            MenuItem::make('objectives')
                    ->setTitle(__('menus.management.objectives.index'))
                    ->setRoute('management.objectives.index'),
            MenuItem::make('categories')
                    ->setTitle(__('menus.management.objectives.categories.index'))
                    ->setRoute('management.objectives.categories.index'),
            MenuItem::make('forms')
                    ->setTitle(__('menus.management.forms.index'))
                    ->setRoute('management.forms.index'),
            MenuItem::make('users')
                    ->setTitle(__('menus.management.users.index'))
                    ->setRoute('management.users.index'),
            MenuItem::make('organization')
                    ->setTitle(__('menus.management.organization.index'))
                    ->setRoute('management.organization.index'),
            MenuItem::make('notifications')
                    ->setTitle(__('menus.notifications.index'))
                    ->setRoute('management.notifications.index'),
            MenuItem::make('reports')
                    ->setTitle(__('menus.reports.index'))
                    ->setRoute('management.reports.index'),
            MenuItem::make('restoring')
                    ->setTitle(__('menus.management.restoring.index'))
                    ->setRoute('management.restoring.index'),
        ]);
    }
}
