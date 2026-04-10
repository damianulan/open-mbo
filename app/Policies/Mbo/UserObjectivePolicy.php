<?php

namespace App\Policies\Mbo;

use App\Models\Core\User;
use App\Models\Mbo\UserObjective;
use App\Warden\PermissionsLib;
use Illuminate\Auth\Access\Response;

class UserObjectivePolicy
{
    public function viewAny(User $user): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_VIEW) ? Response::allow() : Response::deny();
    }

    public function view(User $user, UserObjective $userObjective): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_VIEW) || $user->id === $userObjective->user_id ? Response::allow() : Response::deny();
    }

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

    public function update(User $user, UserObjective $userObjective): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_UPDATE) && $userObjective->user_id !== $user->id ? Response::allow() : Response::deny();
    }

    public function delete(User $user, UserObjective $userObjective): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_DELETE) && $userObjective->user_id !== $user->id ? Response::allow() : Response::deny();
    }

    public function forceDelete(User $user, UserObjective $userObjective): Response
    {
        return $user->isAdmin() ? Response::allow() : Response::deny();
    }
}
