<?php

namespace App\Casts;

use App\Commentable\Casts\InteractiveText;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FormattedText implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $value = InteractiveText::getInteractive($value);

        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $value = Str::replace('<p><br></p>', '', $value);
        $value = Str::replace('<p></p>', '', $value);

        $value = InteractiveText::setInteractive($value, $model);

        return $value;
    }
}
