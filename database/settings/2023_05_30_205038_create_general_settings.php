<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class() extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'OpenMBO');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.theme', 'light-blue');
        $this->migrator->add('general.timezone', 'Europe/Warsaw');
        $this->migrator->add('general.maintenance', false);
        $this->migrator->add('general.debug', true);
        $this->migrator->add('general.debugbar', 'development' === config('app.env') ? true : false);
        $this->migrator->add('general.locale', config('app.locale'));
        $this->migrator->add('general.build', date('YmdHi'));
        $this->migrator->add('general.release', 'production' === config('app.env') ? 'stable' : 'dev');
        $this->migrator->add('general.target_release', 'production' === config('app.env') ? 'stable' : 'dev');

        $this->migrator->add('general.date_format', 'd.m.Y');
        $this->migrator->add('general.time_format', 'H:i');
    }
};
