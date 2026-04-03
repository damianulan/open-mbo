<?php

namespace Tests\Feature\Settings;

use App\Models\Business\Company;
use App\Models\Business\Department;
use App\Models\Core\User;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seeder = TestDatabaseSeeder::class;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();

        config(['cache.default' => 'array']);
        config(['model-cache.cache_store' => 'array']);
        Queue::fake();

        $this->setSetting('users.password_change_firstlogin', false);
        $this->setSetting('users.force_password_change_reset', false);
    }

    public function test_authenticated_user_can_store_department(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $response = $this->actingAs($user)->post(route('settings.organization.departments.store'), [
            'company_id' => $company->id,
            'name' => 'HR',
            'description' => 'Human Resources',
        ]);

        $response->assertRedirect(route('settings.organization.departments.index'));
        $this->assertDatabaseHas('departments', [
            'company_id' => $company->id,
            'name' => 'HR',
        ]);
    }

    public function test_department_store_requires_company(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->from(route('settings.organization.departments.create'))
            ->post(route('settings.organization.departments.store'), [
                'name' => 'HR',
            ]);

        $response->assertRedirect(route('settings.organization.departments.create'));
        $response->assertSessionHasErrors(['company_id']);
    }

    public function test_authenticated_user_can_update_department(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $department = Department::factory()->create([
            'company_id' => $company->id,
            'name' => 'HR',
        ]);

        $response = $this->actingAs($user)->put(route('settings.organization.departments.update', $department), [
            'company_id' => $company->id,
            'name' => 'People Operations',
            'description' => $department->description,
        ]);

        $response->assertRedirect(route('settings.organization.departments.index'));
        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'name' => 'People Operations',
        ]);
    }
}
