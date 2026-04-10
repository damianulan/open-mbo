<?php

namespace App\Settings;

use App\Settings\Abstract\BaseSettings;

class MboSettings extends BaseSettings
{
    public bool $enabled = true;

    public bool $campaigns_enabled = true;

    public bool $campaigns_manual = true;

    public float $campaigns_bonus = 10.00;

    public bool $campaigns_ignore_dates = true;

    public bool $objectives_autofail = true;

    public bool $objectives_self_final_evaluation = true;

    public bool $objectives_weights = true;

    public bool $rewards = true;

    public bool $rewards_proportional = true;

    public bool $manipulate_rewards = false;

    public bool $failed_rewards = false;

    public float $rewards_points_exchange = 1.00;

    public float $rewards_min_evaluation = 100.00;

    public string $rewards_currency = 'PLN';

    public static function group(): string
    {
        return 'mbo';
    }
}
