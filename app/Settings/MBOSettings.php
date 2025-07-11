<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MBOSettings extends Settings
{
    public bool $enabled;

    public bool $campaigns_enabled;

    public bool $campaigns_manual;

    public bool $objectives_autofail;

    public bool $rewards;

    public float $reward_points_exchange;

    public string $reward_currency;

    public static function group(): string
    {
        return 'mbo';
    }
}
