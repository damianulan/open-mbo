<?php

namespace App\Policies\MBO;

use App\Enums\Core\PermissionLib;
use App\Models\Core\User;
use App\Models\MBO\Objective;

class ObjectivePolicy
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
    public function view(User $user, Objective $objective): bool
    {
        // dd($user->can(PermissionLib::MBO_OBJECTIVE_VIEW, $objective));
        return $user->can(PermissionLib::MBO_OBJECTIVE_VIEW);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Objective $objective): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Objective $objective): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Objective $objective): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Objective $objective): bool
    {
        //
    }
}
