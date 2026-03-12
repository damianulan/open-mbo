<?php

namespace App\Support\UI\Page\Navigation\Contracts;

use App\Support\UI\Page\Navigation\PageNav;
use Illuminate\Support\Facades\Context;

trait HasPageNavigation
{
    protected function setPageNav(string $id, array $items): void
    {
        $nav = PageNav::boot($id, $items);

        Context::add('pagenav', $nav);
    }
}
