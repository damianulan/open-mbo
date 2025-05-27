<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\MBOSeeder;
use Database\Seeders\BusinessSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(MBOSeeder::class);
    }
}
