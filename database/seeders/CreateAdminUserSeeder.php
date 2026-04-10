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
    public function run(): void
    {
        $this->upsertAdminUser(
            email: 'admin@damianulan.me',
            password: '123456',
            firstname: 'Site',
            lastname: 'Admin',
            role: 'admin',
            core: true,
        );

        $this->upsertAdminUser(
            email: 'kontakt@damianulan.me',
            password: '12345678',
            firstname: 'Damian',
            lastname: 'Ułan',
            role: 'root',
            core: true,
        );

        $this->upsertAdminUser(
            email: 'helpdesk@damianulan.me',
            password: '123456',
            firstname: 'Admin',
            lastname: 'Helpdesk',
            role: 'support',
            core: true,
        );
    }

    private function upsertAdminUser(
        string $email,
        string $password,
        string $firstname,
        string $lastname,
        string $role,
        bool $core = false,
    ): void {
        $user = User::query()->where('email', $email)->first();

        if (is_null($user)) {
            $user = new User([
                'email' => $email,
                'password' => Hash::make($password),
                'firstname' => $firstname,
                'lastname' => $lastname,
                'gender' => Gender::MALE->value,
                'core' => $core ? 1 : 0,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        } else {
            $user->password = Hash::make($password);
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->gender = Gender::MALE->value;
            $user->core = $core ? 1 : 0;
            $user->email_verified_at = now();
            $user->remember_token = Str::random(10);
        }

        $user->save();

        $profile = $user->profile ?? new UserProfile();
        $profile->birthday ??= fake()->dateTimeBetween('-40 years', '-20years');
        $user->profile()->save($profile);

        $user->assignRoleSlug($role);
    }
}
