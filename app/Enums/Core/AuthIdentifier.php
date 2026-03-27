<?php

namespace App\Enums\Core;

use App\Support\Concerns\EnumHasValues;

enum AuthIdentifier: string
{
    use EnumHasValues;

    case EMAIL = 'email';

    case USERNAME = 'username';

    public function label(): string
    {
        return match ($this) {
            self::EMAIL => __('fields.email'),
            self::USERNAME => __('fields.username'),
        };
    }
}
