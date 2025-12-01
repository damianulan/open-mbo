<?php

namespace App\Support\Notifications\Enums;

use Enumerable\LaraEnum;

class NotificationType extends LaraEnum
{
    public const SYSTEM = 'system';

    public const MAIL = 'mail';
}
