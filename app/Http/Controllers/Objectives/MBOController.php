<?php

namespace App\Http\Controllers\Objectives;

use App\Http\Controllers\AppController;
use App\Support\Page\MenuBuilder;
use App\Support\Page\Bars\MenubarMenu;
use App\Support\Page\Bars\MenuItem;

class MBOController extends AppController
{
    protected MenubarMenu $nav;

    public function nav(): MenubarMenu
    {
        return MenuBuilder::bootMenubar('mbo', [
            MenuItem::make('objectives')
                ->setTitle(__('menus.mbo.objectives.index'))
                ->setRoute('mbo.objectives.index'),
            MenuItem::make('templates')
                ->setTitle(__('menus.mbo.templates.index'))
                ->setRoute('mbo.templates.index'),
            MenuItem::make('categories')
                ->setTitle(__('menus.mbo.categories.index'))
                ->setRoute('mbo.categories.index'),
        ]);
    }
}
