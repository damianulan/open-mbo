<?php

namespace App\Support\Filters\Factories;

use App\Support\Filters\Contracts\FilterContract;
use Exception;

class FilterFinderFactory
{
    public static function make(string|FilterContract $filter): FilterContract
    {
        if ( ! $filter instanceof FilterContract) {
            throw new Exception('Filter not found.');
        }

        return $filter;
    }
}
