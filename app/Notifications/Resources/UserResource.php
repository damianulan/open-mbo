<?php

namespace App\Notifications\Resources;

use App\Models\Core\User;
use App\Support\Notifications\Contracts\NotificationResource;

class UserResource extends NotificationResource
{
    public function __construct(protected User $user) {}

    public function datas(): array
    {
        return [
            'firstname' => $this->user->firstname(),
            'lastname' => $this->user->lastname(),
        ];
    }
}
