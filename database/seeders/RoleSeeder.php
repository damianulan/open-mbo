<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Core\Permission;
use App\Models\Core\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Role::count() > 0){
            return;
        }
        $root = new Role();
        $root->slug = 'root';
        $root->save();

        $admin = new Role();
        $admin->slug = 'admin';
        $admin->save();

        $admin = new Role();
        $admin->slug = 'admin_mbo';
        $admin->save();

        $admin = new Role();
        $admin->slug = 'admin_mbo_category';
        $admin->save();

        $manager = new Role();
        $manager->slug = 'manager';
        $manager->save();

        $supervisor = new Role();
        $supervisor->slug = 'supervisor';
        $supervisor->save();

        $supervisor = new Role();
        $supervisor->slug = 'employee';
        $supervisor->save();
    }
}
