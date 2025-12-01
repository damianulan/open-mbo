<?php

namespace Database\Seeders;

use App\Models\Business\Company;
use App\Models\Business\Department;
use App\Models\Business\Location;
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

        PositionFactory::seedPositions(30);

        Company::factory(2)->has(Location::factory()->count(fake()->numberBetween(1, 3)), 'locations')->create();

        Company::all()->each(function (Company $company): void {
            $company->departments()->saveMany(Department::factory(fake()->numberBetween(4, 8))->make());
        });
    }

    private function createContract(string $name): void
    {
        $contract = new TypeOfContract(array(
            'name' => __('fields.type_of_contract.' . $name),
        ));
        $contract->save();
    }
}
