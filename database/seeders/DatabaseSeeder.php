<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CreateAdminUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\MBOSeeder;
use App\Facades\Modules\ModuleSeeder;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\Core\User;
use App\Models\Core\UserProfile;
use Database\Seeders\BusinessSeeder;

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
        $this->call(MBOSeeder::class);

        ObjectiveTemplate::factory(50)->create();

        $admins_mbo = 2;
        $superadmins = 1;
        for ($i = 1; $i < 40; $i++) {
            $user = User::factory()->has(UserProfile::factory()->count(1), 'profile')->create([
                'email' => 'user' . $i . '@damianulan.me',
            ]);
            if ($user) {
                $user->assignRoleSlug('employee');
            }
            if ($admins_mbo > 0) {
                $user->assignRoleSlug('admin_mbo');
            } else {
                if ($superadmins > 0) {
                    $user->assignRoleSlug('admin');
                }
            }
        }
    }
}
