<?php

namespace App\Support\UI\Page\Navigation\Enums;

use Enumerable\Laravel\Enum;

class NavigationType extends Enum
{
    const SIDEBAR = 'sidebar';

    const PageNav = 'page';

    const TOPBAR = 'topbar';
}
