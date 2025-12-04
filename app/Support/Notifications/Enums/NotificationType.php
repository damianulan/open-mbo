<?php

namespace App\Support\Notifications\Enums;

use Enumerable\Laravel\Enum;

class NotificationType extends Enum
{
    public const SYSTEM = 'system';

    public const MAIL = 'mail';
}
