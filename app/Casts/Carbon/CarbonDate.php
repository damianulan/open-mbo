<?php

namespace App\Casts\Carbon;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CarbonDate implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $value_format = strpos($value, ':')!==false ? 'Y-m-d H:i:s' : 'Y-m-d';
        try {
            return Carbon::createFromFormat($value_format, $value)->format(config('app.date_format'));
        } catch (\Exception $e) {
            dd($value, config('app.date_format'));
            return null;
        }
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return date('Y-m-d', strtotime($value));
    }
}
