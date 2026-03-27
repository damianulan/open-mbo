<?php

namespace App\Enums\Core;

use App\Support\Concerns\EnumHasValues;

enum ExportType: string
{
    use EnumHasValues;

    case EXCEL = 'excel';

    case CSV = 'csv';

    case JSON = 'json';

    case PDF = 'pdf';

    case PRINT = 'print';

    public function label(): string
    {
        return __('globals.exports.' . $this->value);
    }
}
