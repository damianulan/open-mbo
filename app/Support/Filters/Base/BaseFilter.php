<?php

namespace App\Support\Filters\Base;

use App\Support\Filters\Helpers\FilterStringableHelper;
use Illuminate\Support\Str;

abstract class BaseFilter
{
    use FilterStringableHelper;

    protected $key;

    public function getKey(): string
    {
        return $this->key;
    }

    protected function setDefaultKey(): void
    {
        $this->key = $this->namespaceToFilterName(static::class);
    }

    abstract public function getLabel(): string;
}
