<?php

namespace App\Support\UI\Page;

use App\Support\UI\Page\Navigation\PageNav;

class MenuBuilder
{
    public static function bootMenubar(string $id, array $items): PageNav
    {
        return PageNav::boot($id, $items);
    }
}
