<?php

namespace App\Casts\Carbon;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class CarbonDatetime implements CastsAttributes
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
        return empty($value) ? null : Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('app.datetime_format'));
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
        return empty($value) ? null : date('Y-m-d H:i:s', strtotime($value));
    }
}
