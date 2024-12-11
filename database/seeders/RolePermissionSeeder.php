<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Core\Permission;
use App\Models\Core\Role;

class RolePermissionSeeder extends Seeder
{
    private Role $root;
    private Role $support;
    private Role $admin;
    private Role $admin_mbo;
    private Role $objective_coordinator;
    private Role $campaign_coordinator;
    private Role $supervisor;
    private Role $employee;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Roles
        if(Role::count() > 0){
            return;
        }
        $this->root = new Role();
        $this->root->slug = 'root';
        $this->root->save();

        $this->support = new Role();
        $this->support->slug = 'support';
        $this->support->save();

        $this->admin = new Role();
        $this->admin->slug = 'admin';
        $this->admin->assignable = true;
        $this->admin->save();

        $this->admin_mbo = new Role();
        $this->admin_mbo->slug = 'admin_mbo';
        $this->admin_mbo->assignable = true;
        $this->admin_mbo->save();

        $this->objective_coordinator = new Role();
        $this->objective_coordinator->slug = 'objective_coordinator'; // staje się po przypisaniu kategorii celu -- ma dostęp do edycji szablonów celów w kategorii oraz do podsumowania o ich wykorzystywaniu i aktualnym przypisaniu
        $this->objective_coordinator->save();

        $this->campaign_coordinator = new Role();
        $this->campaign_coordinator->slug = 'campaign_coordinator'; // staje się po przypisaniu kampanii
        $this->campaign_coordinator->save();

        $this->manager = new Role();
        $this->manager->slug = 'manager';
        $this->manager->save();

        $this->supervisor = new Role();
        $this->supervisor->slug = 'supervisor';
        $this->supervisor->save();

        $this->employee = new Role();
        $this->employee->slug = 'employee';
        $this->employee->assignable = true;
        $this->employee->save();


        // PERMISSIONS

        // users
        $this->setPermissions();

    }

    private function setPermissions()
    {
        foreach(Permission::$roleSeeds as $slug => $roles){
            $perm = new Permission();
            $perm->slug = $slug;
            if($perm->save()){
                $this->attach($perm, $roles);
            }
        }

    }

    private function attach(Permission $permission, array $to)
    {
        foreach($to as $slug){
            if($slug === 'admins'){
                foreach(['root', 'support', 'admin'] as $role){
                    $this->$role->permissions()->attach($permission);
                }
            } else {
                $this->$slug->permissions()->attach($permission);
            }
        }
    }
}
