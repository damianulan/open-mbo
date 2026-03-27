<?php

namespace App\Support\Filters\Base;

use App\Support\Filters\Helpers\FilterStringableHelper;

abstract class BaseFilter
{
    use FilterStringableHelper;

    protected $key;

    abstract public function getLabel(): string;

    public function getKey(): string
    {
        return $this->key;
    }

    protected function setDefaultKey(): void
    {
        $this->key = $this->namespaceToFilterName(static::class);
    }
}
