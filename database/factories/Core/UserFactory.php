<?php

namespace Database\Factories\Core;

use App\Enums\Users\Gender;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genders = array_values(Gender::conservative());
        $g = $genders[fake()->numberBetween(0, count($genders) - 2)];
        $gender = null;

        switch ($g) {
            case 'm':
                $gender = 'male';
                break;
            case 'f':
                $gender = 'female';
                break;

            default:
                $gender = null;
                break;
        }

        $firstname = fake()->firstName($gender);
        $lastname = fake()->lastName($gender);
        $username = Str::ascii(Str::lower($firstname . '.' . $lastname));
        $email = $username . '@damianulan.me';

        return [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'gender' => $g,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make(User::getNewPassword()),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
