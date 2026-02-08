<?php

namespace Database\Seeders;

use App\Console\Commands\Settings\SettingsMigrate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Sentinel\Console\Commands\AssignRca;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LanguageSeeder::class);
        Artisan::call(SettingsMigrate::class);
        Artisan::call(AssignRca::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(NotificationSeeder::class);
    }
}
