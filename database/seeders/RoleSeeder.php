<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $root = new Role();
        $root->slug = 'root';
        $root->save();

        $admin = new Role();
        $admin->slug = 'admin';
        $admin->save();

        $admin = new Role();
        $admin->slug = 'admin_mbo';
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
