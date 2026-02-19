<?php

namespace Tests\Feature\MBO\Campaign;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Warden\RolesLib;
use Database\Factories\MBO\CampaignFactory;
use Tests\DatabaseTestCase;
use Tests\Traits\HasUserCollection;
use DB;
use Tests\TestCase;
use Database\Seeders\TestDatabaseSeeder;
use App\Models\MBO\Campaign;

class CampaignUpdateTest extends TestCase
{
    use RefreshDatabase, HasUserCollection;

    protected $seeder = TestDatabaseSeeder::class;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setSetting('users.password_change_firstlogin', false);
        $this->fillUsers();
    }

    public function test_coordinator_with_context_can_show_edit_form(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST'
        ]);
        $user = $this->userFactory()->assignRoleSlug(RolesLib::CAMPAIGN_COORDINATOR, $campaign);
        $response = $this->actingAs($user)->get(route('campaigns.edit', $campaign));

        $response->assertStatus(200);
    }

    public function test_coordinator_with_different_context_cannot_show_edit_form(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST'
        ]);

        $user = $this->userFactory()->assignRoleSlug(RolesLib::CAMPAIGN_COORDINATOR, $campaign);
        $campaign = Campaign::factory()->create([
            'name' => 'TEST2'
        ]);

        $response = $this->actingAs($user)->get(route('campaigns.edit', $campaign));

        $response->assertStatus(404);
    }
}
