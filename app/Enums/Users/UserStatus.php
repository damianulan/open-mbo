<?php

namespace App\Enums\Users;

use Enumerable\Laravel\Enum;

class UserStatus extends Enum
{
    public const ACTIVE = 'active';

    public const SUSPENDED = 'suspended';

    public const DELETED = 'deleted';

    public const UNVERIFIED = 'unverified';

    public const UNEMPLOYED = 'unemployed';

    public static function labels(): array
    {
        return [
            self::ACTIVE => __('fields.user_status.' . self::ACTIVE),
            self::SUSPENDED => __('fields.user_status.' . self::SUSPENDED),
            self::DELETED => __('fields.user_status.' . self::DELETED),
            self::UNVERIFIED => __('fields.user_status.' . self::UNVERIFIED),
            self::UNEMPLOYED => __('fields.user_status.' . self::UNEMPLOYED),
        ];
    }
}
