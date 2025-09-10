<?php

namespace App\Enums\Users;

use Lucent\Support\Enum;

class Gender extends Enum
{
    const MALE = 'm';

    const FEMALE = 'f';

    const OTHER = 'o';

    public static function conservative(): array
    {
        return [
            self::MALE,
            self::FEMALE,
        ];
    }

    public static function labels(): array
    {
        return [
            self::MALE => __('fields.gender.'.self::MALE),
            self::FEMALE => __('fields.gender.'.self::FEMALE),
            self::OTHER => __('fields.gender.'.self::OTHER),
        ];
    }
}
