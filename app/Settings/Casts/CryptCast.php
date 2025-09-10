<?php

namespace App\Settings\Casts;

use Illuminate\Support\Facades\Crypt;
use Spatie\LaravelSettings\SettingsCasts\SettingsCast;

class CryptCast implements SettingsCast
{
    public function get($payload)
    {
        if (! empty($payload)) {
            return Crypt::decryptString($payload);
        }

        return $payload;
    }

    public function set($payload)
    {
        if (! empty($payload) && $payload !== 'PassProtection123@') {
            return Crypt::encryptString($payload);
        }

        return $payload;
    }
}
