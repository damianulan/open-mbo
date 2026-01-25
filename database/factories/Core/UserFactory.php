<?php

namespace Database\Factories\Core;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\Users\Gender;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
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

        return array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'gender' => $g,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        );
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => array(
            'email_verified_at' => null,
        ));
    }
}
