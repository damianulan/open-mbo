<?php

namespace Database\Factories\Business;

use App\Models\Business\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shortname = fake()->company();
        $fullname = $shortname . ' ' . fake()->companySuffix();

        return [
            'name' => $fullname,
            'shortname' => $shortname,
            'description' => fake()->realTextBetween(300, 900),
            'taxpayerid' => fake()->taxpayerIdentificationNumber() ?? null,
            'founded_at' => fake()->date(),
        ];
    }
}
