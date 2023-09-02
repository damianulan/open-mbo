<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use App\Facades\Modules\ModuleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateAdminUserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
