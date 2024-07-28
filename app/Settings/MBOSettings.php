<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MBOSettings extends Settings
{
    public bool $enabled;

    public static function group(): string
    {
        return 'mbo';
    }

    public static function repository(): ?string
    {
        return 'modules';
    }
}
