<?php

namespace Database\Seeders;

use App\Models\Core\User;
use App\Models\Core\UserProfile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins_mbo = 10;
        $superadmins = 3;
        for ($i = 1; $i <= fake()->numberBetween(60, 150); $i++) {
            $user = User::factory()->has(UserProfile::factory()->count(1), 'profile')->create([
                'email' => 'user'.$i.'@damianulan.me',
            ]);
            if ($user) {
                $user->assignRoleSlug('employee');
            }
            if ($admins_mbo > 0) {
                $user->assignRoleSlug('admin_mbo');
                $admins_mbo--;
            } else {
                if ($superadmins > 0) {
                    $user->assignRoleSlug('admin');
                    $superadmins--;
                }
            }
        }
    }
}
