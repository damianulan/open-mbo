<?php

namespace App\Settings;

use App\Settings\Abstract\BaseSettings;

class ReportSettings extends BaseSettings
{
    public static function group(): string
    {
        return 'reports';
    }
}
