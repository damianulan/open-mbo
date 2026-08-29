<?php

namespace App\Support\Concerns;

trait EnumHasValues
{
    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }

    public static function names(): array
    {
        return array_column(static::cases(), 'name');
    }

    public static function labels(): array
    {
        $labels = [];

        foreach (static::cases() as $case) {
            $labels[$case->value] = method_exists($case, 'label') ? $case->label() : $case->value;
        }

        return $labels;
    }
}
