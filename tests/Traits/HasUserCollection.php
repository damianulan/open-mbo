<?php

namespace Tests\Traits;

use App\Models\Core\User;
use Illuminate\Support\Collection;
use App\Warden\RolesLib;
use App\Models\Core\UserProfile;

trait HasUserCollection
{
    protected Collection $users;

    protected function fillUsers(): void
    {
        $this->users = new Collection();
        $this->users->put('admin', $this->userFactory()->assignRoleSlug(RolesLib::ADMIN));
        $this->users->put('admin_hr', $this->userFactory()->assignRoleSlug(RolesLib::ADMIN_HR));
        $this->users->put('admin_mbo', $this->userFactory()->assignRoleSlug(RolesLib::ADMIN_MBO));
        $this->users->put('employee', $this->userFactory()->assignRoleSlug(RolesLib::EMPLOYEE));
        $this->users->put('supervisor', $this->userFactory()->assignRoleSlug(RolesLib::SUPERVISOR, $this->getEmployee()));

    }

    protected function userFactory($attributes = []): User
    {
        return User::factory()->has(UserProfile::factory()->count(1), 'profile')->create($attributes);
    }

    protected function getAdmin(): User
    {
        return $this->users->get('admin');
    }

    protected function getAdminHr(): User
    {
        return $this->users->get('admin_hr');
    }

    protected function getAdminMbo(): User
    {
        return $this->users->get('admin_mbo');
    }

    protected function getEmployee(): User
    {
        return $this->users->get('employee');
    }

    protected function getSupervisor(): User
    {
        return $this->users->get('supervisor');
    }

    protected function getMboAdmins(): Collection
    {
        return collect([
            $this->getAdmin(),
            $this->getAdminMbo(),
        ]);
    }

    protected function getNonAdmins(): Collection
    {
        return collect([
            $this->getEmployee(),
            $this->getSupervisor(),
        ]);
    }
}
