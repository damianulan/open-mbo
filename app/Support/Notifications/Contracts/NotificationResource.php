<?php

namespace App\Support\Notifications\Contracts;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;

abstract class NotificationResource implements Jsonable
{
    public function __construct(protected Model $model) {}

    abstract public function datas(): array;

    abstract public static function descriptions(): array;

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
        return json_encode($this->datas(), $options);
    }
}
