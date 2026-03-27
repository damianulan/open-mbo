<?php

namespace App\Enums\Core;

use App\Support\Concerns\EnumHasValues;

enum MessageType: string
{
    use EnumHasValues;

    case SUCCESS = 'success';

    case ERROR = 'error';

    case WARNING = 'warning';

    case INFO = 'info';
}
