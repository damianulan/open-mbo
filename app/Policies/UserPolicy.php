<?php

namespace App\Policies;

use App\Models\Core\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     * @param User $user
     */
    public function viewAny(User $user): bool {}

    /**
     * Determine whether the user can view the model.
     * @param User $user
     * @param User $model
     */
    public function view(User $user, User $model): bool
    {
        return $user->can('users-view', $model);
    }

    /**
     * Determine whether the user can create models.
     * @param User $user
     */
    public function create(User $user): bool {}

    /**
     * Determine whether the user can update the model.
     * @param User $user
     * @param User $model
     */
    public function update(User $user, User $model): bool {}

    /**
     * Determine whether the user can delete the model.
     * @param User $user
     * @param User $model
     */
    public function delete(User $user, User $model): bool {}

    /**
     * Determine whether the user can restore the model.
     * @param User $user
     * @param User $model
     */
    public function restore(User $user, User $model): bool {}
}
