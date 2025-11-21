<?php

namespace App\Settings;

use App\Settings\Abstract\BaseSettings;

class NotificationSettings extends BaseSettings
{
    public bool $mail_notifications = true;
    public bool $system_notifications = true;


    public static function group(): string
    {
        return 'notifications';
    }
}
