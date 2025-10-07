<?php

namespace App\Support\Notifications\Contracts;

use Illuminate\Contracts\Support\Jsonable;

abstract class NotificationResource implements Jsonable
{
    abstract public function datas(): array;

    public function toJson($options = 0)
    {
        return json_encode($this->datas());
    }
}
