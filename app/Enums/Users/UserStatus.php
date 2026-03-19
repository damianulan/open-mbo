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

    public function label(): string
    {
        return __('fields.user_status.' . $this->value);
    }
}
