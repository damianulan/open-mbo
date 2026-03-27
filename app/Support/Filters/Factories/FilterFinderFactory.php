<?php

namespace App\Support\Filters\Factories;

use App\Support\Filters\Contracts\FilterContract;
use Exception;

class FilterFinderFactory
{
    public static function make(string|FilterContract $filter): FilterContract
    {
        if (is_string($filter) && class_exists($filter)) {
            $filter = app()->make($filter);
        }
        if ( ! $filter instanceof FilterContract) {
            throw new Exception('Filter not found.');
        }

        return $filter;
    }
}
