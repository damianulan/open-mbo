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
    public function run(): void
    {
        foreach (TypeOfContract::$contracts as $contract) {
            $this->createContract($contract);
        }

        if (0 === Position::query()->count()) {
            PositionFactory::seedPositions(30);
        }

        if (Company::query()->count() < 2) {
            Company::factory(2 - Company::query()->count())
                ->has(Location::factory()->count(fake()->numberBetween(1, 3)), 'locations')
                ->create();
        }

        Company::all()->each(function (Company $company): void {
            if (0 === $company->departments()->count()) {
                $company->departments()->saveMany(Department::factory(fake()->numberBetween(4, 8))->make());
            }
        });
    }

    private function createContract(string $name): void
    {
        TypeOfContract::query()->updateOrCreate(
            ['name' => __('fields.type_of_contract.' . $name)],
            ['name' => __('fields.type_of_contract.' . $name)],
        );
    }
}
