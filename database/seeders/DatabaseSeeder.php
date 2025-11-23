<?php

namespace Database\Seeders;

use App\Console\Commands\Settings\SettingsMigrate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call(SettingsMigrate::class);
        Artisan::call('sentinel:run');
        $this->call(BusinessSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        Artisan::call('cache:clear');
        $this->call(UserSeeder::class);
        $this->call(NotificationSeeder::class);

        $this->call(MBOSeeder::class);
    }
}
