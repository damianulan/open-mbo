<?php

namespace App\Support\Search\Factories;

use App\Support\Search\Dtos\ResultItem;
use Illuminate\Database\Eloquent\Model;

abstract class IndexResource
{
    public function __construct(protected Model $model) {}

    abstract public function attributes(): array;

    abstract public static function getModelClass(): string;

    abstract public function resultItem(string $phrase): ResultItem;

    final public function getModel(): Model
    {
        return $this->model;
    }

    final public function getKey()
    {
        return $this->model->getKey();
    }

    public function toJson($options = 0)
    {
        return json_encode($this->attributes(), $options);
    }
}
