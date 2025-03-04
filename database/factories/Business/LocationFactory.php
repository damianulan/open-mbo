<?php

namespace Database\Factories\Business;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = fake()->city();
        $street = fake()->streetName();
        $name = $city . ' - ' . $street;
        $num = fake()->buildingNumber() . '/' . fake()->buildingNumber();
        return [
            'name' => $name,
            'address_line_1' => $street,
            'address_line_2' => $num,
            'city' => $city,
            'country' => fake()->country(),
            'postal_code' => fake()->postcode(),
            'active' => true,
        ];
    }
}
