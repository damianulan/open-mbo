<?php

namespace Tests\Feature\MBO\Campaign;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\HasUserCollection;
use Tests\TestCase;
use Database\Seeders\TestDatabaseSeeder;

class CampaignCreateTest extends TestCase
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

    /**
     * A basic feature test example.
     */
    public function test_admins_can_show_create_form(): void
    {
        $admin = $this->getAdmin();
        foreach($this->getMboAdmins() as $admin) {
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
}
