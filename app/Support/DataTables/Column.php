<?php

namespace App\Support\DataTables;

use Yajra\DataTables\Html\Column as YarjaColumn;

class Column extends YarjaColumn
{
    public function __construct($attributes = [])
    {
        if ( ! isset($attributes['viewable'])) {
            $attributes['viewable'] = true;
        }

        parent::__construct($attributes);
    }

    public function viewable(bool $visible = true): static
    {
        $this->attributes['viewable'] = $visible;

        return $this;
    }
}
