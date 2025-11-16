<?php

namespace App\Settings;

use App\Settings\Casts\CryptCast;
use Spatie\LaravelSettings\Settings;

class MailSettings extends Settings
{
    // MAILING
    public ?string $mail_mailer;

    public ?string $mail_host;

    public ?int $mail_port;

    public ?string $mail_username;

    public ?string $mail_password;

    public ?string $mail_encryption;

    public ?string $mail_from_address;

    public ?string $mail_from_name;

    public bool $mail_catchall_enabled;

    public ?string $mail_catchall_receiver;

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
        if ( ! empty($this->mail_password)) {
            $this->mail_password = 'PassProtection123@';
        }

        return $this;
    }
}
