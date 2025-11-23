<?php

namespace App\Settings;

use App\Settings\Casts\CryptCast;
use App\Settings\Abstract\BaseSettings;

class MailSettings extends BaseSettings
{
    // MAILING
    public ?string $mail_mailer = 'smtp';

    public ?string $mail_host = 'mailhog';

    public ?int $mail_port = 587;

    public ?string $mail_username = null;

    public ?string $mail_password = null;

    public ?string $mail_encryption = null;

    public ?string $mail_from_address = 'hello@openmbo.com';

    public ?string $mail_from_name = 'OpenMBO';

    public bool $mail_catchall_enabled = false;

    public ?string $mail_catchall_receiver = 'openmbo@damianulan.me';

    public static function group(): string
    {
        return 'server';
    }

    public static function casts(): array
    {
        return [
            'mail_password' => CryptCast::class,
        ];
    }

    public function safePassword()
    {
        if (! empty($this->mail_password)) {
            $this->mail_password = 'PassProtection123@';
        }

        return $this;
    }
}
