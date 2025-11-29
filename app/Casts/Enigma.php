<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Enigma implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     * @param Model $model
     * @param string $key
     * @param mixed $value
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $encryption = (bool) config('app.enigma_models');
        if ($encryption) {
            if ( ! is_null($value)) {
                try {
                    return Crypt::decryptString($value);
                } catch (DecryptException $e) {
                    report($e);

                    return false;
                }
            }
        }

        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     * @param Model $model
     * @param string $key
     * @param mixed $value
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $encryption = (bool) config('app.enigma_models');
        if ($encryption) {
            if ( ! is_null($value)) {
                try {
                    return Crypt::encryptString($value);
                } catch (EncryptException $e) {
                    report($e);

                    return false;
                }
            }
        }

        return $value;
    }
}
