<?php

namespace App\Support\Notifications\Contracts;

use Illuminate\Database\Eloquent\Model;

interface NotifiableEvent
{
    public function notifiable(): Model;
}
