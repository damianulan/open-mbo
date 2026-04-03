<?php

namespace Tests\Feature\Mbo\Campaign;

use App\Models\Mbo\Campaign;
use Carbon\Carbon;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Tests\Traits\HasUserCollection;

class CampaignCreateTest extends TestCase
{
    use HasUserCollection, RefreshDatabase;

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

    public function test_admins_can_show_create_form(): void
    {
        $admin = $this->getAdmin();
        foreach ($this->getMboAdmins() as $admin) {
            $response = $this->actingAs($admin)->get(route('campaigns.create'));

            $response->assertStatus(200);
        }
    }

    public function test_non_admins_cannot_show_create_form(): void
    {
        foreach ($this->getNonAdmins() as $user) {
            $response = $this->actingAs($user)->get(route('campaigns.create'));

            $response->assertStatus(403);
        }
    }

    public function test_mbo_admin_can_create_campaign(): void
    {
        $admin = $this->getAdminMbo();
        $coordinator = $this->getEmployee();
        $payload = $this->validPayload([
            'period' => '2026Q1TST',
            'user_ids' => [$coordinator->id],
        ]);

        $response = $this->actingAs($admin)->post(route('campaigns.store'), $payload);

        $campaign = Campaign::query()
            ->withoutGlobalScopes()
            ->where('period', $payload['period'])
            ->first();

        $this->assertNotNull($campaign);
        $response->assertRedirect(route('campaigns.show', ['campaign' => $campaign->uuid]));
        $this->assertDatabaseHas('campaigns', [
            'id' => $campaign->id,
            'period' => $payload['period'],
        ]);
    }

    public function test_non_admin_cannot_create_campaign(): void
    {
        $employee = $this->getEmployee();
        $payload = $this->validPayload(['period' => '2026Q2TST']);

        $response = $this->actingAs($employee)->post(route('campaigns.store'), $payload);

        $response->assertStatus(403);
    }

    public function test_create_campaign_requires_name(): void
    {
        $admin = $this->getAdminMbo();
        $payload = $this->validPayload([
            'name' => '',
            'period' => '2026Q3TST',
        ]);

        $response = $this->actingAs($admin)->from(route('campaigns.create'))->post(route('campaigns.store'), $payload);

        $response->assertRedirect(route('campaigns.create'));
        $response->assertSessionHasErrors(['name']);
    }

    protected function validPayload(array $overrides = []): array
    {
        $start = Carbon::now()->addDays(2)->startOfDay();

        return array_merge([
            'name' => 'Campaign Test',
            'period' => '2026Q1',
            'description' => 'Test campaign description',
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
