<?php

namespace App\Support\Filters\Contracts;

use Illuminate\Database\Query\Builder;

interface FilterContract
{
    public function getQuery(Builder $query): Builder;

    public function query(Builder $query): Builder;

    public function getKey(): string;

    public function getLabel(): string;

    public function getValue();
}
