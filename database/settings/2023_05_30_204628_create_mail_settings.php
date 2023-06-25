<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('server.mail_mailer', 'smtp');
        $this->migrator->add('server.mail_host', 'mailhog');
        $this->migrator->add('server.mail_port', 587);
        $this->migrator->add('server.mail_username', null);
        $this->migrator->add('server.mail_password', null);
        $this->migrator->add('server.mail_encryption', null);
        $this->migrator->add('server.mail_from_address', 'hello@blender.com');
        $this->migrator->add('server.mail_from_name', 'Blender LMS');

    }
};
