<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\HasUserCollection;
use Tests\TestCase;
use Database\Seeders\TestDatabaseSeeder;

class UserViewTest extends TestCase
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
    public function test_user_can_view_another_user(): void
    {
        $user = $this->userFactory();
        $anotherUser = $this->userFactory();
        $response = $this->actingAs($user)->get(route('users.show', $anotherUser));

        $response->assertStatus(200);
    }
}
