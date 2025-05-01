<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Core\Permission;
use App\Enums\Core\PermissionLib;
use App\Enums\Core\SystemRolesLib;
use App\Models\Core\Role;

class RolePermissionSeeder extends Seeder
{
    private Role $root;
    private Role $support;
    private Role $admin;
    private Role $admin_mbo;
    private Role $admin_hr;
    private Role $objective_coordinator;
    private Role $campaign_coordinator;
    private Role $director;
    private Role $manager;
    private Role $team_leader;
    private Role $supervisor;
    private Role $employee;

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
        $this->root = new Role();
        $this->root->slug = 'root';
        $this->root->assignable = false;
        $this->root->save();

        $this->support = new Role();
        $this->support->slug = 'support';
        $this->support->assignable = false;
        $this->support->save();

        $this->admin = new Role();
        $this->admin->slug = 'admin';
        $this->admin->save();

        $this->admin_mbo = new Role();
        $this->admin_mbo->slug = 'admin_mbo';
        $this->admin_mbo->save();

        $this->admin_hr = new Role();
        $this->admin_hr->slug = 'admin_hr'; // has some user management privileges
        $this->admin_hr->save();

        $this->objective_coordinator = new Role();
        $this->objective_coordinator->slug = 'objective_coordinator'; // staje się po przypisaniu kategorii celu -- ma dostęp do edycji szablonów celów w kategorii oraz do podsumowania o ich wykorzystywaniu i aktualnym przypisaniu
        $this->objective_coordinator->assignable = false;
        $this->objective_coordinator->save();

        $this->campaign_coordinator = new Role();
        $this->campaign_coordinator->slug = 'campaign_coordinator'; // staje się po przypisaniu kampanii
        $this->campaign_coordinator->assignable = false;
        $this->campaign_coordinator->save();

        $this->director = new Role();
        $this->director->slug = 'director'; // in company context
        $this->director->assignable = false;
        $this->director->save();

        $this->manager = new Role();
        $this->manager->slug = 'manager'; // in department context
        $this->manager->assignable = false;
        $this->manager->save();

        $this->team_leader = new Role();
        $this->team_leader->slug = 'team_leader'; // in a team context
        $this->team_leader->assignable = false;
        $this->team_leader->save();

        $this->supervisor = new Role();
        $this->supervisor->slug = 'supervisor';
        $this->supervisor->assignable = false;
        $this->supervisor->save();

        $this->employee = new Role();
        $this->employee->slug = 'employee';
        $this->employee->save();


        // PERMISSIONS

        // users
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
                foreach (['root', 'support', 'admin'] as $role) {
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
