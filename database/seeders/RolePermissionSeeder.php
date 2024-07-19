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
    private Role $adminMBO;
    private Role $adminMBOCat;
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
        $this->admin->save();

        $this->adminMBO = new Role();
        $this->adminMBO->slug = 'admin_mbo'; // staje się po przypisaniu kategorii mbo
        $this->adminMBO->save();

        $this->manager = new Role();
        $this->manager->slug = 'manager';
        $this->manager->save();

        $this->supervisor = new Role();
        $this->supervisor->slug = 'supervisor';
        $this->supervisor->save();

        $this->employee = new Role();
        $this->employee->slug = 'employee';
        $this->employee->save();


        // PERMISSIONS

        // users
        $this->impersonate();

    }

    private function impersonate()
    {
        $impersonate = new Permission();
        $impersonate->slug = 'users-impersonate';
        $impersonate->save();
        $this->attach($impersonate, 'root', 'support', 'admin');
    }

    private function attach(Permission $permission, ... $to)
    {
        foreach($to as $slug){
            $this->$slug->permissions()->attach($permission);
        }
    }
}
