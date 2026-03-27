<?php

namespace App\Enums\Forms;

use App\Support\Concerns\EnumHasValues;

enum StructureField: string
{
    use EnumHasValues;

    case TEXT = 'text';

    case SELECT = 'select';
}
