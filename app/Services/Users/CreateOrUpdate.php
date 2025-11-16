<?php

namespace App\Services\Users;

use Lucent\Services\Service;
use App\Models\Core\User;
use App\Models\Core\UserProfile;

final class CreateOrUpdate extends Service
{
    public function handle(): User
    {
        $id = $this->user->id ?? null;
        $user = User::fillFromRequest($this->request(), $id);
        $supervisors_ids = $this->request()->input('supervisors_ids') ?? [];
        $roles_ids = $this->request()->input('roles_ids') ?? [];

        if ($user->save()) {
            $profile = UserProfile::fillFromRequest($this->request());
            $profile->user_id = $user->id;

            $profile->save();
            $user->refreshSupervisors($supervisors_ids);
            $user->refreshRole($roles_ids);
            $this->user = $user;
        }

        return $user;
    }
}
