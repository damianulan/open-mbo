<?php

namespace App\Filters\Users;

use App\Support\Filters\Types\SearchFilter;
use Illuminate\Database\Query\Builder;

class FullnameFilter extends SearchFilter
{
    public function label(): string
    {
        return __('fields.firstname_lastname');
    }

    public function query(Builder $query): Builder
    {
        $sql = "CONCAT(firstname,' ',lastname)  like ?";
        $query->whereRaw($sql, ["%{$this->getValue()}%"]);

        return $query;
    }
}
