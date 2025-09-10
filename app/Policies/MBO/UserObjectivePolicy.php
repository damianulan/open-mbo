<?php

namespace App\Policies\MBO;

use App\Models\Core\User;
use App\Models\MBO\UserObjective;
use App\Warden\PermissionsLib;

class UserObjectivePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserObjective $userObjective): bool
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_VIEW);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    public function evaluate(User $user, UserObjective $userObjective): bool
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_EVALUATE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserObjective $userObjective): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserObjective $userObjective): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, UserObjective $userObjective): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, UserObjective $userObjective): bool
    {
        //
    }
}
