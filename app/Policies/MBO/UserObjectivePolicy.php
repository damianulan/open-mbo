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
        return $user->can(PermissionsLib::MBO_OBJECTIVE_VIEW);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserObjective $userObjective): bool
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_VIEW) || $user->id === $userObjective->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_CREATE);
    }

    public function evaluate(User $user, UserObjective $userObjective): bool
    {
        $campaignCondition = $userObjective->user_campaign() ? $userObjective->user_campaign()->objectivesCanBeEvaluated() : true;

        return ($user->can(PermissionsLib::MBO_OBJECTIVE_EVALUATE) && ! $userObjective->isSelfEvaluated()) && $userObjective->isAfterDeadline() && $campaignCondition;
    }

    public function self_evaluate(User $user, UserObjective $userObjective): bool
    {
        $campaignCondition = $userObjective->user_campaign() ? $userObjective->user_campaign()->objectivesCanBeSelfEvaluated() : true;

        return $userObjective->user_id === $user->id && $userObjective->isEvaluated() && ! $userObjective->isSelfEvaluated() && $userObjective->isAfterDeadline() && $campaignCondition;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserObjective $userObjective): bool
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_UPDATE) && $userObjective->user_id !== $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserObjective $userObjective): bool
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_DELETE) && $userObjective->user_id !== $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, UserObjective $userObjective): bool
    {
        return $user->isAdmin();
    }
}
