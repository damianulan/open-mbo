<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class NotificationSettings extends Settings
{
    public static function group(): string
    {
        return 'notifications';
    }
}
