<?php

namespace App\Policies;

use App\Models\Core\User;
use App\Warden\PermissionsLib;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsLib::USERS_VIEW);
    }

    public function viewList(User $user): bool
    {
        return $user->can(PermissionsLib::USERS_LIST);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->can(PermissionsLib::USERS_VIEW, $model);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function preview(User $user, User $model): bool
    {
        return $user->can(PermissionsLib::USERS_PREVIEW, $model);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsLib::USERS_CREATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->can(PermissionsLib::USERS_EDIT, $model);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->can(PermissionsLib::USERS_DELETE, $model) && $model->canBeDeleted();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->can(PermissionsLib::USERS_RESTORE, $model);
    }

    public function impersonate(User $user, User $model): bool
    {
        return $model->canBeImpersonated() && $user->canImpersonate($model);
    }

    public function block(User $user, User $model): bool
    {
        return $user->can(PermissionsLib::USERS_BLOCK, $model) && $model->canBeBlocked();
    }

    public function reset(User $user, User $model): bool
    {
        return $user->can(PermissionsLib::USERS_PASSWORD_RESET, $model);
    }

    public function employments(User $user, User $model): bool
    {
        return $user->can(PermissionsLib::USERS_EMPLOYMENTS_MANAGE, $model);
    }
}
