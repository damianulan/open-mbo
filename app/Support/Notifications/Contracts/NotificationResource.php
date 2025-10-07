<?php

namespace App\Support\Notifications\Contracts;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;

abstract class NotificationResource implements Jsonable
{
    abstract public function datas(): array;

    public function toJson($options = 0)
    {
        return json_encode($this->datas());
    }
}
