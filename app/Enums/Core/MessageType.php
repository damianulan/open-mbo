<?php

namespace App\Enums\Core;

use Enumerable\LaraEnum;

class MessageType extends LaraEnum
{
    public const SUCCESS = 'success';

    public const ERROR = 'error';

    public const WARNING = 'warning';

    public const INFO = 'info';
}
