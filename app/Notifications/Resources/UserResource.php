<?php

namespace App\Notifications\Resources;

use App\Models\Core\User;
use App\Support\Notifications\Contracts\NotificationResource;

class UserResource extends NotificationResource
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public static function descriptions(): array
    {
        return array(
            'firstname' => __('fields.firstname'),
            'lastname' => __('fields.lastname'),
            'email' => __('fields.email'),
        );
    }

    public function datas(): array
    {
        return array(
            'firstname' => $this->model->firstname(),
            'lastname' => $this->model->lastname(),
            'email' => $this->model->email,
        );
    }
}
