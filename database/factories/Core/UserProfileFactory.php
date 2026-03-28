<?php

namespace Database\Factories\Core;

use App\Models\Core\UserProfile;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class UserProfileFactory extends Factory
{
    protected $model = UserProfile::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'birthday' => fake()->dateTimeBetween('-40 years', '-20years'),
        ];
    }
}
