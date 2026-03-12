<?php

namespace App\Support\Filters\Helpers;

use Illuminate\Support\Str;

trait FilterStringableHelper
{
    protected static function namespaceToFilterName(string $namespace): string
    {
        return Str::replace(['\\', 'app_'], '', Str::snake($namespace));
    }
}
