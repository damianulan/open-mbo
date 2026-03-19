<?php

namespace App\Enums\Users;

use App\Support\Concerns\EnumHasValues;

enum Gender: string
{
    use EnumHasValues;

    case MALE = 'm';

    case FEMALE = 'f';

    case OTHER = 'o';

    public static function conservative(): array
    {
        return [
            self::MALE->value,
            self::FEMALE->value,
        ];
    }

    public function label(): string
    {
        return __('fields.gender.' . $this->value);
    }
}
