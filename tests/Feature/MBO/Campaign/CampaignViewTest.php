<?php

namespace Tests\Feature\MBO\Campaign;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Warden\RolesLib;
use Tests\Traits\HasUserCollection;
use Tests\TestCase;
use Database\Seeders\TestDatabaseSeeder;
use App\Models\MBO\Campaign;

class CampaignViewTest extends TestCase
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

    public function test_user_enrolled_can_show_campaign(): void
    {
        $user = $this->getEmployee();
        $campaign = Campaign::factory()->create([
            'name' => 'TEST'
        ])->assignUser($user->id);
        $response = $this->actingAs($user)->get(route('campaigns.show', $campaign));

        $response->assertStatus(200);
    }

    public function test_user_not_enrolled_can_show_campaign(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST'
        ]);
        $user = $this->getEmployee();
        $response = $this->actingAs($user)->get(route('campaigns.show', $campaign));

        $response->assertStatus(404);
    }


    public function test_coordinator_with_context_can_show_campaign(): void
    {
        $campaign = Campaign::factory()->create([
            'name' => 'TEST'
        ]);
        $user = $this->userFactory()->assignRoleSlug(RolesLib::CAMPAIGN_COORDINATOR, $campaign);
        $response = $this->actingAs($user)->get(route('campaigns.show', $campaign));

        $response->assertStatus(200);
    }
}
