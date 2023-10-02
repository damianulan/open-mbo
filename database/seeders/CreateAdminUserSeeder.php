<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Config;
use App\Models\User;
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
        $admin1 = new User();
        $admin1->firstname = 'Site';
        $admin1->lastname = 'Admin';
        $admin1->email = 'admin@damianulan.me';
        $admin1->birthday = fake()->dateTimeBetween('-40 years', '-20years');
        $admin1->password = Hash::make('123456');
        $admin1->gender = Gender::MALE->value;
        $admin1->save();
        $admin1->assignRole('admin');

        $admin1 = new User();
        $admin1->firstname = 'Damian';
        $admin1->lastname = 'Ułan';
        $admin1->email = 'kontakt@damianulan.me';
        $admin1->birthday = fake()->dateTimeBetween('-40 years', '-20years');
        $admin1->password = Hash::make('123456');
        $admin1->gender = Gender::MALE->value;
        $admin1->save();
        $admin1->assignRole('root');

        $user1 = new User();
        $user1->firstname = 'Test';
        $user1->lastname = 'User';
        $user1->email = 'demo@damianulan.me';
        $user1->birthday = fake()->dateTimeBetween('-40 years', '-20years');
        $user1->password = Hash::make('123456');
        $user1->gender = Gender::MALE->value;
        $user1->save();
        $user1->assignRole('employee');

    }

}
