<?php

namespace Database\Seeders;

use App\Enums\Users\Gender;
use App\Models\Core\User;
use App\Models\Core\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User([
            'email' => 'admin@damianulan.me',
            'password' => Hash::make('123456'),
        ]);
        $user->save();
        $profile = new UserProfile([
            'firstname' => 'Site',
            'lastname' => 'Admin',
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
            'gender' => Gender::MALE,
        ]);
        $user->profile()->save($profile);
        $user->assignRoleSlug('admin');

        $user = new User([
            'email' => 'kontakt@damianulan.me',
            'password' => Hash::make('12345678'),
            'core' => 1,
        ]);
        $user->save();
        $profile = new UserProfile([
            'firstname' => 'Damian',
            'lastname' => 'Ułan',
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
            'gender' => Gender::MALE,
        ]);
        $user->profile()->save($profile);
        $user->assignRoleSlug('root');

        $user = new User([
            'email' => 'helpdesk@damianulan.me',
            'password' => Hash::make('123456'),
            'core' => 1,
        ]);
        $user->save();
        $profile = new UserProfile([
            'firstname' => 'Admin',
            'lastname' => 'Helpdesk',
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
            'gender' => Gender::MALE,
        ]);
        $user->profile()->save($profile);
        $user->assignRoleSlug('support');
    }
}
