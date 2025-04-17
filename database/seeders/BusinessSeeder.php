<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Business\TypeOfContract;
use App\Models\Business\Location;
use App\Models\Business\Company;
use App\Models\Business\Department;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(TypeOfContract::$contracts as $contract){
            $this->createContract($contract);
        }

        Company::factory(3)->has(Location::factory()->count(fake()->numberBetween(1,3)), 'locations')->create();
    }

    private function createContract(string $name)
    {
        $contract = new TypeOfContract([
            'name' => __('faker.type_of_contract.' . $name),
            'shortname' => $name,
        ]);
        $contract->save();
    }
}
