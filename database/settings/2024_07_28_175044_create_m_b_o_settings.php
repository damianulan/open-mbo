<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('mbo.enabled', true);
        $this->migrator->add('mbo.campaigns_enabled', true);
        $this->migrator->add('mbo.campaigns_manual', true);
        $this->migrator->add('mbo.objectives_autofail', true);
        $this->migrator->add('mbo.rewards', true);
        $this->migrator->add('mbo.min_evaluation', 0.00);
        $this->migrator->add('mbo.reward_points_exchange', 1.00);
        $this->migrator->add('mbo.reward_currency', 'EUR');
    }
};
