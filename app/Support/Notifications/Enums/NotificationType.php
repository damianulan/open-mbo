<?php

namespace App\Support\Notifications\Enums;

use App\Support\Concerns\EnumHasValues;

enum NotificationType: string
{
    use EnumHasValues;

    case SYSTEM = 'system';

    case MAIL = 'mail';
}
