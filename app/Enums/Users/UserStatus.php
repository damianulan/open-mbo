<?php

namespace App\Enums\Users;

use App\Support\Concerns\EnumHasValues;

enum UserStatus: string
{
    use EnumHasValues;

    case ACTIVE = 'active';

    case SUSPENDED = 'suspended';

    case DELETED = 'deleted';

    case UNVERIFIED = 'unverified';

    case UNEMPLOYED = 'unemployed';

    public function label(): ?string
    {
        return match ($this) {
            self::ACTIVE => __('fields.user_status.' . self::ACTIVE->value),
            self::SUSPENDED => __('fields.user_status.' . self::SUSPENDED->value),
            self::DELETED => __('fields.user_status.' . self::DELETED->value),
            self::UNVERIFIED => __('fields.user_status.' . self::UNVERIFIED->value),
            self::UNEMPLOYED => __('fields.user_status.' . self::UNEMPLOYED->value),
            default => null,
        };
    }
}
