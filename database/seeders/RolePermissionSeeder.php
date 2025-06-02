<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Core\Permission;
use App\Enums\Core\PermissionLib;
use App\Enums\Core\SystemRolesLib;
use App\Models\Core\Role;

class RolePermissionSeeder extends Seeder
{
    private static $roles = [
        'root',
        'support',
        'admin',
        'admin_mbo',
        'admin_hr',
        'objective_coordinator',
        'campaign_coordinator',
        'director',
        'manager',
        'team_leader',
        'supervisor',
        'employee',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        if (Role::count() > 0) {
            return;
        }

        foreach (SystemRolesLib::values() as $name) {
            $this->$name = new Role();
            $this->$name->slug = $name;
            $this->$name->assignable = in_array($name, SystemRolesLib::assignable());
            $this->$name->save();
        }


        // PERMISSIONS
        $this->setPermissions();
    }

    private function setPermissions()
    {
        foreach (PermissionLib::core() as $slug => $roles) {
            $perm = new Permission();
            $perm->slug = $slug;
            $perm->assignable = false;
            if ($perm->save()) {
                $this->attach($perm, $roles);
            }
        }

        foreach (PermissionLib::normal() as $slug => $roles) {
            $perm = new Permission();
            $perm->slug = $slug;
            $perm->assignable = true;
            if ($perm->save()) {
                $this->attach($perm, $roles);
            }
        }
    }

    private function attach(Permission $permission, array $to)
    {
        foreach ($to as $slug) {
            if ($slug === 'admins') {
                foreach (SystemRolesLib::admins() as $role) {
                    $this->$role->permissions()->attach($permission);
                }
            } elseif ($slug === '*') {
                foreach (self::$roles as $role) {
                    $this->$role->permissions()->attach($permission);
                }
            } else {
                $this->$slug->permissions()->attach($permission);
            }
        }
    }
}
