<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MBOSettings extends Settings
{
    public bool $enabled;
    public bool $campaigns_enabled;
    public bool $campaigns_manual;
    public bool $rewards;

    public static function group(): string
    {
        return 'mbo';
    }
}
