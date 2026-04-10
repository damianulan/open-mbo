<?php

namespace App\Casts\Carbon;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class CarbonDatetime implements CastsAttributes
{
    /**
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return empty($value) ? null : Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('app.datetime_format'));
    }

    /**
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return empty($value) ? null : date('Y-m-d H:i:s', strtotime($value));
    }
}
