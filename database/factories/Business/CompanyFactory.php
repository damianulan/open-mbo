<?php

namespace Database\Factories\Business;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shortname = fake()->company();
        $fullname = $shortname.' '.fake()->companySuffix();

        return [
            'name' => $fullname,
            'shortname' => $shortname,
            'description' => fake()->realTextBetween(300, 900),
            'founded_at' => fake()->date(),
        ];
    }
}
