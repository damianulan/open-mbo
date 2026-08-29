<?php

namespace App\Filters\Collections;

use App\Filters\Users\FullnameFilter;
use App\Support\Filters\Services\FilterService;
use Illuminate\Container\Attributes\Singleton;

#[Singleton]
final class UsersTableFilters extends FilterService
{
    protected array $items = [
        FullnameFilter::class,
    ];
}
