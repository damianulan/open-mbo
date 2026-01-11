<?php

namespace App\Settings;

use App\Settings\Abstract\BaseSettings;

class UserSettings extends BaseSettings
{
    public bool $password_change_firstlogin = true;

    public bool $force_password_change_reset = true;

    public bool $multiple_employments = true;

    public static function group(): string
    {
        return 'users';
    }
}
