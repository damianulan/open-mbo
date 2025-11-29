<?php

namespace App\Enums\Core;

use Lucent\Support\Enum;

class MessageType extends Enum
{
    public const SUCCESS = 'success';

    public const ERROR = 'error';

    public const WARNING = 'warning';

    public const INFO = 'info';
}
