<?php

namespace App\Policies\Mbo;

use App\Models\Core\User;
use App\Models\Mbo\Objective;
use App\Warden\PermissionsLib;
use Illuminate\Auth\Access\Response;

class ObjectivePolicy
{
    public function view(User $user, Objective $objective): Response
    {
        return $user->can(PermissionsLib::MBO_OBJECTIVE_VIEW) ? Response::allow() : Response::deny();
    }
}
