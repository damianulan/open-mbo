<?php

namespace Tests\Feature\Mbo\Campaign;

use App\Models\Mbo\Campaign;
use App\Warden\RolesLib;
use Carbon\Carbon;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Tests\Traits\HasUserCollection;

class CampaignUpdateTest extends TestCase
{
    use RefreshDatabase, HasUserCollection;

    protected $seeder = TestDatabaseSeeder::class;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        File::ensureDirectoryExists(storage_path('framework/cache/data'));
        Queue::fake();
        config(['cache.default' => 'array']);
        config(['model-cache.cache_store' => 'array']);
        $this->setSetting('users.password_change_firstlogin', false);
        $this->setSetting('users.force_password_change_reset', false);
        $this->fillUsers();
    }

    public function test_coordinator_with_context_can_show_edit_form(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST',
        ]);
        $user = $this->userFactory()->assignRoleSlug(RolesLib::CAMPAIGN_COORDINATOR, $campaign);
        $response = $this->actingAs($user)->get(route('campaigns.edit', $campaign));

        $response->assertStatus(200);
    }

    public function test_coordinator_with_different_context_cannot_show_edit_form(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST',
        ]);

        $user = $this->userFactory()->assignRoleSlug(RolesLib::CAMPAIGN_COORDINATOR, $campaign);
        $campaign = Campaign::factory()->create([
            'name' => 'TEST2',
        ]);

        $response = $this->actingAs($user)->get(route('campaigns.edit', $campaign));

        $response->assertStatus(404);
    }

    public function test_coordinator_with_context_can_update_campaign(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST',
            'period' => 'OLD2026',
        ]);
        $user = $this->userFactory()->assignRoleSlug(RolesLib::CAMPAIGN_COORDINATOR, $campaign);
        $payload = $this->validPayload([
            'period' => 'UPD2026A',
            'name' => 'Updated Campaign',
        ]);

        $response = $this->actingAs($user)->put(route('campaigns.update', $campaign), $payload);

        $response->assertRedirect(route('campaigns.show', $campaign));
        $this->assertDatabaseHas('campaigns', [
            'id' => $campaign->id,
            'period' => 'UPD2026A',
        ]);
    }

    public function test_coordinator_with_different_context_cannot_update_campaign(): void
    {
        $contextCampaign = Campaign::factory()->create(['name' => 'CTX']);
        $targetCampaign = Campaign::factory()->create(['name' => 'TARGET']);
        $user = $this->userFactory()->assignRoleSlug(RolesLib::CAMPAIGN_COORDINATOR, $contextCampaign);
        $payload = $this->validPayload(['period' => 'UPD2026B']);

        $response = $this->actingAs($user)->put(route('campaigns.update', $targetCampaign), $payload);

        $response->assertStatus(404);
    }

    public function test_update_campaign_requires_period(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST',
        ]);
        $user = $this->userFactory()->assignRoleSlug(RolesLib::CAMPAIGN_COORDINATOR, $campaign);
        $payload = $this->validPayload([
            'period' => '',
        ]);

        $response = $this->actingAs($user)
            ->from(route('campaigns.edit', $campaign))
            ->put(route('campaigns.update', $campaign), $payload);

        $response->assertRedirect(route('campaigns.edit', $campaign));
        $response->assertSessionHasErrors(['period']);
    }

    protected function validPayload(array $overrides = []): array
    {
        $start = Carbon::now()->addDays(2)->startOfDay();

        return array_merge([
            'name' => 'Campaign Update',
            'period' => 'UPD2026',
            'description' => 'Updated campaign description',
            'definition_from' => $start->copy()->toDateTimeString(),
            'definition_to' => $start->copy()->addDays(1)->toDateTimeString(),
            'disposition_from' => $start->copy()->addDays(2)->toDateTimeString(),
            'disposition_to' => $start->copy()->addDays(3)->toDateTimeString(),
            'realization_from' => $start->copy()->addDays(4)->toDateTimeString(),
            'realization_to' => $start->copy()->addDays(5)->toDateTimeString(),
            'evaluation_from' => $start->copy()->addDays(6)->toDateTimeString(),
            'evaluation_to' => $start->copy()->addDays(7)->toDateTimeString(),
            'self_evaluation_from' => $start->copy()->addDays(8)->toDateTimeString(),
            'self_evaluation_to' => $start->copy()->addDays(9)->toDateTimeString(),
            'draft' => 0,
            'manual' => 0,
            'user_ids' => [],
        ], $overrides);
    }
}
