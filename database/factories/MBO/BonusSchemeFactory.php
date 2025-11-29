<?php

namespace Database\Factories\MBO;

use App\Lib\MBO\Bonus\BonusSchemeOptions;
use App\Models\MBO\BonusScheme;
use Illuminate\Database\Eloquent\Factories\Factory;

class BonusSchemeFactory extends Factory
{
    protected $model = BonusScheme::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return array(
            'name' => trim(fake()->realTextBetween(10, 50), '.'),
            'description' => fake()->realTextBetween(300, 500),
            'options' => BonusSchemeOptions::fake(),
        );
    }
}
