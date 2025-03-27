<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SurveysSettings extends Settings
{
    public bool $enabled;

    public static function group(): string
    {
        return 'surveys';
    }

}
