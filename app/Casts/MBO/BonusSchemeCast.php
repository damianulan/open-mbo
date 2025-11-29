<?php

namespace App\Casts\MBO;

use App\Lib\MBO\Bonus\BonusSchemeOptions;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class BonusSchemeCast implements CastsAttributes
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
        return BonusSchemeOptions::make(json_decode($value, true));
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
        if ($value instanceof BonusSchemeOptions) {
            return $value->toJson();
        }

        return null;
    }
}
