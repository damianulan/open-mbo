<?php

namespace App\Http\Controllers\Objectives;

use App\Http\Controllers\AppController;
use App\Support\Page\Bars\MenubarMenu;
use App\Support\Page\Bars\MenuItem;
use App\Support\Page\MenuBuilder;

class MBOController extends AppController
{
    protected MenubarMenu $nav;

    public function nav(): MenubarMenu
    {
        return MenuBuilder::bootMenubar('mbo', [
            MenuItem::make('objectives')
                ->setTitle(__('menus.objectives.index'))
                ->setRoute('objectives.index'),
            MenuItem::make('templates')
                ->setTitle(__('menus.templates.index'))
                ->setRoute('templates.index'),
            MenuItem::make('categories')
                ->setTitle(__('menus.categories.index'))
                ->setRoute('categories.index'),
        ]);
    }
}
