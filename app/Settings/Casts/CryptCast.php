<?php

namespace App\Settings\Casts;

use Spatie\LaravelSettings\SettingsCasts\SettingsCast;
use Illuminate\Support\Facades\Crypt;

class CryptCast implements SettingsCast
{
    public function get($payload)
    {
        if(!is_null($payload)){
            return Crypt::decryptString($payload);
        }
        return $payload;
    }

    public function set($payload)
    {
        return Crypt::encryptString($payload);
    }
}