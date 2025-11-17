<?php

namespace App\Commentable\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CommentContent implements CastsAttributes
{
    public static function commentQuotation(string $value): string
    {
        if (Str::contains($value, '<blockquote><em>--- @')) {

            $start = '<blockquote><em>--- @';
            $end = ' ---</blockquote>';

            $start_after = '<div class="commentable-quotation"><blockquote><em>--- @';
            $end_after = ' </blockquote></div>';

            $quote_inner = Str::between($value, $start, $end);
            if ( ! empty($quote_inner)) {
                $quote_old = $start . $quote_inner . $end;
                $quote = $start_after . $quote_inner . $end_after;

                $value = Str::replace($quote_old, $quote, $value);
            }
        }

        return $value;
    }

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
        $value = str_replace('<p><br></p>', '', $value);
        $value = str_replace('<p></p>', '', $value);
        $value = trim($value);
        $value = self::commentQuotation($value);
        $value = InteractiveText::setInteractive($value, $model);

        return $value;
    }
}
