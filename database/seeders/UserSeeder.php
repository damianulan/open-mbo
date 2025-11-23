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
use Illuminate\Database\Eloquent\Builder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $y = 0;
        try {
            DB::beginTransaction();
            foreach ($companies as $company) {
                $num = fake()->numberBetween(60, 80);
                $admins_mbo = 5;
                $superadmins = 3;

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
                    if (! $position) {
                        $position = Position::whereNotIn('name', ['CEO', 'CTO', 'CFO'])->get()->random(1)->first();
                        $isManagement = false;
                    }

                    $chance = fake()->numberBetween(1, 3);
                    UserEmployment::create([
                        'user_id' => $user->id,
                        'company_id' => $company->id,
                        'contract_id' => TypeOfContract::all()->random(1)->first()->id,
                        'position_id' => $position->id,
                        'department_id' => $company->departments()->get()->random(1)->first()->id,
                        'employment' => fake()->dateTimeBetween('-10 years', '-3 months'),
                        'release' => 3 === $chance && ! $isManagement ? fake()->dateTimeBetween('-10 months', '+1 year') : null,

                    ]);
                }

                $company->departments->each(function (Department $department) use ($company) {
                    User::whereHas('employments', function (Builder $query) use ($company) {
                        $query->whereNull('release');
                        $query->where('company_id', $company->id);
                    })->take(1)->get()->each(function (User $supervisor) use ($company, $department) {
                        $supervisor->assignRoleSlug('supervisor');

                        User::whereHas('employments', function (Builder $query) use ($company, $department) {
                            $query->whereNull('release');
                            $query->where('company_id', $company->id);
                            $query->where('department_id', $department->id);
                        })->get()->each(function (User $user) use ($supervisor) {
                            $user->refreshSupervisors([$supervisor->id]);
                        });
                    });
                });
            }



            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
