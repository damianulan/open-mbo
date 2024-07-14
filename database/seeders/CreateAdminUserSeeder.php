<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Core\Role;
use App\Models\Config;
use App\Models\Core\User;
use App\Models\Core\UserProfile;
use App\Enums\Users\Gender;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::count() > 0){
            return;
        }
        $user = new User([
            'email' => 'admin@damianulan.me',
            'password' => Hash::make('123456'),
        ]);
        $user->save();
        $profile = new UserProfile([
            'firstname' => 'Site',
            'lastname' => 'Admin',
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
            'gender' => Gender::MALE->value
        ]);
        $user->profile()->save($profile);
        $user->assignRole('admin');

        //
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
            'gender' => Gender::MALE->value
        ]);
        $user->profile()->save($profile);
        $user->assignRole('root');

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
            'gender' => Gender::MALE->value
        ]);
        $user->profile()->save($profile);
        $user->assignRole('support');

        //
        $user = new User([
            'email' => 'demo@damianulan.me',
            'password' => Hash::make('12345678'),
        ]);
        $user->save();
        $profile = new UserProfile([
            'firstname' => 'Test',
            'lastname' => 'User',
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
            'gender' => Gender::FEMALE->value
        ]);
        $user->profile()->save($profile);
        $user->assignRole('employee');

    }

}
