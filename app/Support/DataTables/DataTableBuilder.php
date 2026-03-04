<?php

namespace App\Support\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class DataTableBuilder extends EloquentDataTable
{
    public function __construct(Model|EloquentBuilder $model)
    {
        parent::__construct($model);
    }
}
