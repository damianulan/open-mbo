<?php

namespace App\Notifications\Resources;

use App\Models\MBO\UserObjective;
use App\Support\Notifications\Contracts\NotificationResource;

class UserObjectiveResource extends NotificationResource
{
    public function __construct(UserObjective $userObjective)
    {
        parent::__construct($userObjective);
    }

    public static function descriptions(): array
    {
        return array(
            'objective_name' => 'Objective name',
        );
    }

    public function datas(): array
    {
        return array(
            'objective_name' => $this->model->objective->name,
        );
    }
}
