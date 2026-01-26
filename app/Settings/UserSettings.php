<?php

namespace App\Settings;

use App\Settings\Abstract\BaseSettings;

class UserSettings extends BaseSettings
{
    public bool $password_change_firstlogin = true;

    public bool $force_password_change_reset = true;

    public int $password_validity_days = 0;

    public int $password_min_length = 8;

    public int $password_min_letters = 0;

    public int $password_min_numbers = 0;

    public int $password_min_symbols = 0;

    public int $password_not_repeat = 0;

    public bool $multiple_employments = true;

    public static function group(): string
    {
        return 'users';
    }
}
