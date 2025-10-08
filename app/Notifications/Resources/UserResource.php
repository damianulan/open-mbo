<?php

namespace App\Notifications\Resources;

use App\Models\Core\User;
use App\Support\Notifications\Contracts\NotificationResource;

class UserResource extends NotificationResource
{
    public function __construct(protected User $user)
    {
        parent::__construct($user);
    }

    public function datas(): array
    {
        return [
            'firstname' => $this->user->firstname(),
            'lastname' => $this->user->lastname(),
            'email' => $this->user->email,
        ];
    }

    public function descriptions(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
        ];
    }
}
