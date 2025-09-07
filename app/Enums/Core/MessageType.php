<?php

namespace App\Enums\Core;

use Lucent\Support\Enum;

class MessageType extends Enum
{
    const SUCCESS = 'success';

    const ERROR = 'error';

    const WARNING = 'warning';

    const INFO = 'info';
}
