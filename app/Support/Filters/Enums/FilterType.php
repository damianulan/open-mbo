<?php

namespace App\Support\Filters\Enums;

use Enumerable\Laravel\Enum;

class FilterType extends Enum
{
    const SEARCH = 'search';

    const SELECT = 'select';

    const MULTISELECT = 'multiselect';
}
