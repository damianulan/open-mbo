<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('mbo.enabled', true);
        $this->migrator->add('mbo.campaigns_enabled', true);
        $this->migrator->add('mbo.campaigns_manual', true);
        $this->migrator->add('mbo.campaigns_bonus', 20.00);
        $this->migrator->add('mbo.campaigns_ignore_dates', true);
        $this->migrator->add('mbo.objectives_autofail', true);
        $this->migrator->add('mbo.rewards', true);
        $this->migrator->add('mbo.rewards_proportional', true);
        $this->migrator->add('mbo.manipulate_rewards', false);
        $this->migrator->add('mbo.failed_rewards', false);
        $this->migrator->add('mbo.rewards_min_evaluation', 100.00);
        $this->migrator->add('mbo.rewards_points_exchange', 1.00);
        $this->migrator->add('mbo.rewards_currency', 'EUR');
    }
};
