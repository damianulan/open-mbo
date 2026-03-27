<?php

namespace App\Support\Filters\Enums;

use App\Support\Concerns\EnumHasValues;

enum FilterType: string
{
    use EnumHasValues;

    case SEARCH = 'search';

    case SELECT = 'select';

    case MULTISELECT = 'multiselect';
}
