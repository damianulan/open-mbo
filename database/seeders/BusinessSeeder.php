<?php

namespace Database\Seeders;

use App\Models\Business\Company;
use App\Models\Business\Location;
use App\Models\Business\Position;
use App\Models\Business\TypeOfContract;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (TypeOfContract::$contracts as $contract) {
            $this->createContract($contract);
        }

        Position::factory(15)->create();
        Company::factory(3)->has(Location::factory()->count(fake()->numberBetween(1, 3)), 'locations')->create();
    }

    private function createContract(string $name)
    {
        $contract = new TypeOfContract([
            'name' => __('faker.type_of_contract.' . $name)
        ]);
        $contract->save();
    }
}
