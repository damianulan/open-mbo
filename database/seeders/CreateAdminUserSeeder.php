<?php

namespace Database\Seeders;

use App\Enums\Users\Gender;
use App\Models\Core\User;
use App\Models\Core\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'firstname' => 'Site',
            'lastname' => 'Admin',
            'gender' => Gender::MALE,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user->save();
        $profile = new UserProfile([
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
        ]);
        $user->profile()->save($profile);
        $user->assignRoleSlug('admin');

        $user = new User([
            'email' => 'kontakt@damianulan.me',
            'password' => Hash::make('12345678'),
            'core' => 1,
            'firstname' => 'Damian',
            'lastname' => 'Ułan',
            'gender' => Gender::MALE,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user->save();
        $profile = new UserProfile([
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
        ]);
        $user->profile()->save($profile);
        $user->assignRoleSlug('root');

        $user = new User([
            'email' => 'helpdesk@damianulan.me',
            'password' => Hash::make('123456'),
            'core' => 1,
            'firstname' => 'Admin',
            'lastname' => 'Helpdesk',
            'gender' => Gender::MALE,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $user->save();
        $profile = new UserProfile([
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
        ]);
        $user->profile()->save($profile);
        $user->assignRoleSlug('support');
    }
}
