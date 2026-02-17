<?php

namespace App\Enums\Core;

use Enumerable\Laravel\Enum;

class AuthIdentifier extends Enum
{
    const EMAIL = 'email';

    const USERNAME = 'username';

    public static function labels(): array
    {
        return [
            self::EMAIL => __('fields.email'),
            self::USERNAME => __('fields.username'),
        ];
    }
}
