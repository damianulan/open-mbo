<?php

namespace App\Policies\MBO;

use App\Models\Core\User;
use App\Models\MBO\UserObjective;
use App\Warden\PermissionsLib;
use Illuminate\Auth\Access\Response;

class UserObjectivePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_VIEW) ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserObjective $userObjective): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_VIEW) || $user->id === $userObjective->user_id ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_CREATE) ? Response::allow() : Response::deny();
    }

    public function evaluate(User $user, UserObjective $userObjective): Response
    {
        $campaignCondition = $userObjective->user_campaign() ? $userObjective->user_campaign()->objectivesCanBeEvaluated() : true;

        return $user->can(PermissionsLib::MBO_OBJECTIVE_EVALUATE) && $userObjective->isAfterDeadline() && $campaignCondition ? Response::allow() : Response::deny();
    }

    public function self_evaluate(User $user, UserObjective $userObjective): Response
    {
        $campaignCondition = $userObjective->user_campaign() ? $userObjective->user_campaign()->objectivesCanBeSelfEvaluated() : true;

        return $userObjective->user_id === $user->id && $userObjective->isAfterDeadline() && $campaignCondition ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserObjective $userObjective): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_UPDATE) && $userObjective->user_id !== $user->id ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserObjective $userObjective): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_DELETE) && $userObjective->user_id !== $user->id ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, UserObjective $userObjective): Response
    {
        return $user->isAdmin() ? Response::allow() : Response::deny();
    }
}
