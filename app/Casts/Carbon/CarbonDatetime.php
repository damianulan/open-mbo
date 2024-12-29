<?php

namespace App\Casts\Carbon;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CarbonDatetime implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return empty($value) ? null:Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('app.datetime_format'));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return empty($value) ? NULL:date('Y-m-d H:i:s', strtotime($value));
    }
}
