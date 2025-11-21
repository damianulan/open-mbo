<?php

namespace App\Settings;

use App\Settings\Abstract\BaseSettings;

class UserSettings extends BaseSettings
{
    public bool $multiple_employments = true;

    public static function group(): string
    {
        return 'users';
    }
}
