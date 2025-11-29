<?php

namespace App\Policies\MBO;

use App\Models\Core\User;
use App\Models\MBO\Objective;
use App\Warden\PermissionsLib;

class ObjectivePolicy
{
    /**
     * Determine whether the user can view any models.
     * @param User $user
     */
    public function viewAny(User $user): bool {}

    /**
     * Determine whether the user can view the model.
     * @param User $user
     * @param Objective $objective
     */
    public function view(User $user, Objective $objective): bool
    {
        // dd($user->can(PermissionLib::MBO_OBJECTIVE_VIEW, $objective));
        return $user->can(PermissionsLib::MBO_OBJECTIVE_VIEW);
    }

    /**
     * Determine whether the user can create models.
     * @param User $user
     */
    public function create(User $user): bool {}

    /**
     * Determine whether the user can update the model.
     * @param User $user
     * @param Objective $objective
     */
    public function update(User $user, Objective $objective): bool {}

    /**
     * Determine whether the user can delete the model.
     * @param User $user
     * @param Objective $objective
     */
    public function delete(User $user, Objective $objective): bool {}

    /**
     * Determine whether the user can restore the model.
     * @param User $user
     * @param Objective $objective
     */
    public function restore(User $user, Objective $objective): bool {}

    /**
     * Determine whether the user can permanently delete the model.
     * @param User $user
     * @param Objective $objective
     */
    public function forceDelete(User $user, Objective $objective): bool {}
}
