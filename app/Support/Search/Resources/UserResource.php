<?php

namespace App\Support\Search\Resources;

use App\Support\Search\Factories\IndexResource;
use App\Models\Core\User;
use App\Support\Search\Dtos\ResultItem;

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
            'firstname' => $this->model->firstname,
            'lastname' => $this->model->lastname,
            'email' => $this->model->email,
            'position' => $this->model->employment?->position->name,
            'company' => $this->model->employment?->company->name,
            'gender' => $this->model->gender === 'm' ? 'Mężczyzna' : 'Kobieta',
        );
    }

    public function resultItem(): ResultItem
    {
        return new ResultItem(array(
            'title' => $this->model->name,
            'description' => null,
            'link' => route('users.show', $this->model->id),
        ));
    }

}
