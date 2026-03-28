<?php

namespace Database\Factories\Business;

use App\Models\Business\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Location>
 */
class LocationFactory extends Factory
{
    /**
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
