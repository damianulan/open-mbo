<?php

namespace App\Enums\Core;

use Enumerable\Laravel\Enum;

class MessageType extends Enum
{
    public const SUCCESS = 'success';

    public const ERROR = 'error';

    public const WARNING = 'warning';

    public const INFO = 'info';
}
