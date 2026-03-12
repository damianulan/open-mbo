<?php

namespace Tests\Feature\Settings;

use App\Models\Business\TypeOfContract;
use App\Models\Core\User;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ContractTypeControllerTest extends TestCase
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

    public function test_authenticated_user_can_store_contract_type(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('settings.organization.contracts.store'), [
            'name' => 'Employment contract',
            'description' => 'Standard employment contract',
        ]);

        $response->assertRedirect(route('settings.organization.contracts.index'));
        $this->assertDatabaseHas('type_of_contracts', [
            'name' => 'Employment contract',
        ]);
    }

    public function test_contract_type_update_uses_unique_validation_for_name(): void
    {
        $user = User::factory()->create();
        $firstContract = TypeOfContract::query()->create([
            'name' => 'First Contract',
        ]);
        $secondContract = TypeOfContract::query()->create([
            'name' => 'Second Contract',
        ]);

        $response = $this->actingAs($user)
            ->from(route('settings.organization.contracts.edit', $firstContract->id))
            ->put(route('settings.organization.contracts.update', $firstContract->id), [
                'name' => $secondContract->name,
                'description' => $firstContract->description,
            ]);

        $response->assertRedirect(route('settings.organization.contracts.edit', $firstContract->id));
        $response->assertSessionHasErrors(['name']);
    }
}
