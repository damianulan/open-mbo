<?php

namespace App\Support\UI\Page\Navigation\Enums;

use App\Support\Concerns\EnumHasValues;

enum NavigationType: string
{
    use EnumHasValues;

    case SIDEBAR = 'sidebar';

    case PAGE = 'page';

    case TOPBAR = 'topbar';
}
