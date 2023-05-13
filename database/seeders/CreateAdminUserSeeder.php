<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Config;
use App\Models\User;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin1 = new User();
        $admin1->firstname = 'Site';
        $admin1->lastname = 'Admin';
        $admin1->email = 'admin@damianulan.me';
        $admin1->password = Hash::make('123456');
        $admin1->gender = '1';
        $admin1->save();

        $admin1 = new User();
        $admin1->firstname = 'Damian';
        $admin1->lastname = 'Ułan';
        $admin1->email = 'kontakt@damianulan.me';
        $admin1->password = Hash::make('123456');
        $admin1->gender = '1';
        $admin1->save();

        $admin1 = new User();
        $admin1->firstname = 'Rafał';
        $admin1->lastname = 'Orłowski';
        $admin1->email = 'rafal@damianulan.me';
        $admin1->password = Hash::make('123456');
        $admin1->gender = '1';
        $admin1->save();

        $user1 = new User();
        $user1->firstname = 'Test';
        $user1->lastname = 'User';
        $user1->email = 'demo@damianulan.me';
        $user1->password = Hash::make('123456');
        $user1->gender = '0';
        $user1->save();
    }

}
