<?php

namespace App\Enums\Users;

use Enumerable\Laravel\Enum;

class Gender extends Enum
{
    public const MALE = 'm';

    public const FEMALE = 'f';

    public const OTHER = 'o';

    public static function conservative(): array
    {
        return array(
            self::MALE,
            self::FEMALE,
        );
    }

    public static function labels(): array
    {
        return array(
            self::MALE => __('fields.gender.' . self::MALE),
            self::FEMALE => __('fields.gender.' . self::FEMALE),
            self::OTHER => __('fields.gender.' . self::OTHER),
        );
    }
}
