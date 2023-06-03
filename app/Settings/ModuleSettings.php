<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ModuleSettings extends Settings
{

    public static function group(): string
    {
        return 'modules';
    }
}