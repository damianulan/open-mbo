<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\MBOSeeder;
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
        $this->call(RolePermissionSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(MBOSeeder::class);

        // \App\Models\Core\User::factory(10)->create();

        // \App\Models\Core\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
