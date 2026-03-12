<?php

namespace App\Http\Controllers\Objectives;

use App\Http\Controllers\AppController;
use App\Support\UI\Page\Navigation\Contracts\HasPageNavigation;
use App\Support\UI\Page\Navigation\MenuItem;

class MBOController extends AppController
{
    use HasPageNavigation;

    protected function addPageNav(): void
    {
        $this->setPageNav('mbo', [
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
