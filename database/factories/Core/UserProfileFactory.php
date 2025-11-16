<?php

namespace Database\Factories\Core;

use App\Enums\Users\Gender;
use App\Models\Core\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserProfileFactory extends Factory
{
    protected $model = UserProfile::class;

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

        return [
            'firstname' => fake()->firstName($gender),
            'lastname' => fake()->lastName($gender),
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
            'gender' => $g,
        ];
    }
}
