<?php

namespace Database\Seeders;

use App\Models\Business\Company;
use App\Models\Business\Department;
use App\Models\Business\Location;
use App\Models\Business\Position;
use App\Models\Business\TypeOfContract;
use Database\Factories\Business\PositionFactory;
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

        PositionFactory::seedAdminPositions();
        Position::factory(15)->create();
        Department::factory(10)->create();
        Company::factory(2)->has(Location::factory()->count(fake()->numberBetween(1, 3)), 'locations')->create();
    }

    private function createContract(string $name): void
    {
        $contract = new TypeOfContract(array(
            'name' => __('faker.type_of_contract.' . $name),
        ));
        $contract->save();
    }
}
