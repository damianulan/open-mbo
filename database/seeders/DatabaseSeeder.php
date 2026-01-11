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
        $this->call(LanguageSeeder::class);

        Artisan::call(SettingsMigrate::class);
        Artisan::call('sentinel:run');
        $this->call(CreateAdminUserSeeder::class);
        $this->call(BusinessSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(NotificationSeeder::class);

        $this->call(MBOSeeder::class);
    }
}
