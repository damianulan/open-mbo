<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'OpenMBO');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.theme', 'light-blue');
        $this->migrator->add('general.timezone', 'Europe/Warsaw');
        $this->migrator->add('general.maintenance', false);
        $this->migrator->add('general.debug', true);
        $this->migrator->add('general.debugbar', config('app.env') === 'development' ? true : false);
        $this->migrator->add('general.locale', config('app.locale'));
        $this->migrator->add('general.build', date('YmdHi'));
        $this->migrator->add('general.release', config('app.env') === 'production' ? 'stable' : 'dev');
        $this->migrator->add('general.target_release', config('app.env') === 'production' ? 'stable' : 'dev');

        $this->migrator->add('general.date_format', 'd.m.Y');
        $this->migrator->add('general.time_format', 'H:i');
    }
};
