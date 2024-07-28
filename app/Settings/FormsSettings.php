<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FormsSettings extends Settings
{
    public bool $enabled;

    public static function group(): string
    {
        return 'forms';
    }

    public static function repository(): ?string
    {
        return 'modules';
    }
}
