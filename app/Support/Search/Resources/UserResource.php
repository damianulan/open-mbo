<?php

namespace App\Support\Search\Resources;

use App\Support\Search\Factories\IndexResource;
use App\Models\Core\User;

class UserResource extends IndexResource
{
    public function __construct(User $model)
    {
        return parent::__construct($model);
    }

    public static function getModelClass(): string
    {
        return User::class;
    }

    public function attributes(): array
    {
        return array(
            'firstname' => $this->model->firstname(),
            'lastname' => $this->model->lastname(),
            'email' => $this->model->email,
            'employment_start_date' => $this->model?->employment?->employment->format('d.m.Y'),
            'position' => $this->model->employment?->position->name,
            'gender' => $this->model->profile?->gender === 'm' ? 'Mężczyzna' : 'Kobieta',
        );
    }

}
