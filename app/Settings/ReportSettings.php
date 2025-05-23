<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ReportSettings extends Settings
{

    public static function group(): string
    {
        return 'reports';
    }
}
