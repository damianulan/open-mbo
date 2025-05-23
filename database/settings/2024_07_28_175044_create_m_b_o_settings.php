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
    }
};
