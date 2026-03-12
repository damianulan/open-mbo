<?php

namespace Tests\Feature\MBO\Campaign;

use App\Models\MBO\Campaign;
use App\Warden\RolesLib;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Tests\Traits\HasUserCollection;

class CampaignViewTest extends TestCase
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

    public function test_user_enrolled_without_campaign_permission_cannot_show_campaign(): void
    {
        $user = $this->getEmployee();
        $campaign = Campaign::factory()->create([
            'name' => 'TEST',
        ])->assignUser($user->id);
        $response = $this->actingAs($user)->get(route('campaigns.show', $campaign));

        $response->assertStatus(404);
    }

    public function test_user_not_enrolled_can_show_campaign(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST',
        ]);
        $user = $this->getEmployee();
        $response = $this->actingAs($user)->get(route('campaigns.show', $campaign));

        $response->assertStatus(404);
    }

    public function test_coordinator_with_context_can_show_campaign(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST',
        ]);
        $user = $this->userFactory()->assignRoleSlug(RolesLib::CAMPAIGN_COORDINATOR, $campaign);
        $response = $this->actingAs($user)->get(route('campaigns.show', $campaign));

        $response->assertStatus(200);
    }

    public function test_admin_mbo_can_show_any_campaign(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST',
        ]);
        $admin = $this->getAdminMbo();
        $response = $this->actingAs($admin)->get(route('campaigns.show', $campaign));

        $response->assertStatus(200);
    }

    public function test_admin_mbo_can_view_campaigns_index(): void
    {
        $admin = $this->getAdminMbo();
        $response = $this->actingAs($admin)->get(route('campaigns.index'));

        $response->assertStatus(200);
    }

    public function test_employee_cannot_view_campaigns_index(): void
    {
        $employee = $this->getEmployee();
        $response = $this->actingAs($employee)->get(route('campaigns.index'));

        $response->assertStatus(403);
    }
}
