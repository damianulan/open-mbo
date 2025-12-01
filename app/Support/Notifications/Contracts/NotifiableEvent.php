<?php

namespace App\Support\Notifications\Contracts;

use Illuminate\Database\Eloquent\Model;

interface NotifiableEvent
{
    public static function description(): string;

    public function notifiable(): Model;

    public function notificationDelay(): int;

    public function checkConditions(): bool;
}
