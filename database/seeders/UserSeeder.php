<?php

namespace Database\Seeders;

use App\Models\Business\Company;
use App\Models\Business\Department;
use App\Models\Business\Position;
use App\Models\Business\TypeOfContract;
use App\Models\Business\UserEmployment;
use App\Models\Core\User;
use App\Models\Core\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $companies = Company::all();
        $y = 0;
        foreach ($companies as $company) {
            $num = fake()->numberBetween(30, 80);
            $admins_mbo = 5;
            $superadmins = 3;

            try {
                DB::beginTransaction();

                for ($i = 1; $i <= $num; $i++) {
                    $y++;
                    $user = User::factory()
                        ->has(UserProfile::factory()->count(1), 'profile')
                        ->create([
                            'email' => 'user' . $y . '@damianulan.me',
                        ]);

                    $position = null;
                    if ($user) {
                        $user->assignRoleSlug('employee');
                    }
                    if ($admins_mbo > 0) {
                        $user->assignRoleSlug('admin_mbo');
                        $admins_mbo--;
                    } else {
                        if ($superadmins > 0) {
                            $user->assignRoleSlug('admin');
                            $pos = match ($superadmins) {
                                2 => 'CTO',
                                3 => 'CFO',
                                default => 'CEO',
                            };
                            $position = Position::where('name', $pos)->first();
                            $superadmins--;
                        }
                    }

                    $isManagement = true;
                    if ( ! $position) {
                        $position = Position::whereNotIn('name', ['CEO', 'CTO', 'CFO'])->get()->random(1)->first();
                        $isManagement = false;
                    }

                    $chance = fake()->numberBetween(1, 3);
                    UserEmployment::create([
                        'user_id' => $user->id,
                        'company_id' => $company->id,
                        'contract_id' => TypeOfContract::all()->random(1)->first()->id,
                        'position_id' => $position->id,
                        'department_id' => Department::all()->random(1)->first()->id,
                        'employment' => fake()->dateTimeBetween('-10 years', '-3 months'),
                        'release' => 3 === $chance && ! $isManagement ? fake()->dateTimeBetween('-10 months', '+1 year') : null,

                    ]);
                }
                DB::commit();
            } catch (Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }
    }
}
