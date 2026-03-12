<?php

namespace Tests\Feature\Settings;

use App\Models\Business\Company;
use App\Models\Core\User;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
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

    public function test_authenticated_user_can_store_company(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('settings.organization.company.store'), [
            'name' => 'Acme Corporation',
            'shortname' => 'ACME',
            'taxpayerid' => 'PL1234567890',
            'founded_at' => '2010-05-10',
            'description' => 'Sample company description',
        ]);

        $response->assertRedirect(route('settings.organization.company.index'));
        $this->assertDatabaseHas('companies', [
            'name' => 'Acme Corporation',
            'shortname' => 'ACME',
            'taxpayerid' => 'PL1234567890',
        ]);
    }

    public function test_company_update_uses_unique_validation_for_name_and_shortname(): void
    {
        $user = User::factory()->create();
        $firstCompany = Company::factory()->create([
            'name' => 'First Company',
            'shortname' => 'FIRST',
        ]);
        $secondCompany = Company::factory()->create([
            'name' => 'Second Company',
            'shortname' => 'SECOND',
        ]);

        $response = $this->actingAs($user)
            ->from(route('settings.organization.company.edit', $firstCompany->id))
            ->put(route('settings.organization.company.update', $firstCompany->id), [
                'name' => $secondCompany->name,
                'shortname' => $secondCompany->shortname,
                'taxpayerid' => $firstCompany->taxpayerid,
                'founded_at' => optional($firstCompany->founded_at)->format('Y-m-d'),
                'description' => $firstCompany->description,
            ]);

        $response->assertRedirect(route('settings.organization.company.edit', $firstCompany->id));
        $response->assertSessionHasErrors(['name', 'shortname']);
    }
}
