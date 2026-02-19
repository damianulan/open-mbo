<?php

namespace App\Policies;

use App\Models\Core\User;
use App\Warden\PermissionsLib;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->can(PermissionsLib::USERS_VIEW) ? Response::allow() : Response::deny();
    }

    public function viewList(User $user): Response
    {
        return $user->can(PermissionsLib::USERS_LIST) ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        return $user->can(PermissionsLib::USERS_VIEW, $model) ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function preview(User $user, User $model): Response
    {
        return $user->can(PermissionsLib::USERS_PREVIEW, $model) ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->can(PermissionsLib::USERS_CREATE) ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        return $user->can(PermissionsLib::USERS_EDIT, $model) ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        return $user->can(PermissionsLib::USERS_DELETE, $model) && $model->canBeDeleted() ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): Response
    {
        return $user->can(PermissionsLib::USERS_RESTORE, $model) ? Response::allow() : Response::deny();
    }

    public function impersonate(User $user, User $model): Response
    {
        return $model->canBeImpersonated() && $user->canImpersonate($model) ? Response::allow() : Response::deny();
    }

    public function block(User $user, User $model): Response
    {
        return $user->can(PermissionsLib::USERS_BLOCK, $model) && $model->canBeBlocked() ? Response::allow() : Response::deny();
    }

    public function reset(User $user, User $model): Response
    {
        return $user->can(PermissionsLib::USERS_PASSWORD_RESET, $model) ? Response::allow() : Response::deny();
    }

    public function employments(User $user, User $model): Response
    {
        return $user->can(PermissionsLib::USERS_EMPLOYMENTS_MANAGE, $model) ? Response::allow() : Response::deny();
    }
}
