<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Blender LMS');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.theme', 'light');
        $this->migrator->add('general.timezone', 'Europe/Warsaw');
        $this->migrator->add('general.debug', true);
        $this->migrator->add('general.locale', 'pl');
        $this->migrator->add('general.build', 202306031936);
        $this->migrator->add('general.release', '0.0.1');

        $this->migrator->add('general.date_format', 'd-m-Y');
        $this->migrator->add('general.time_format', 'H:i');
    }
};
