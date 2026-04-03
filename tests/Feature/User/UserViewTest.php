<?php

namespace Tests\Feature\User;

use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\HasUserCollection;

class UserViewTest extends TestCase
{
    use HasUserCollection, RefreshDatabase;

    protected $seeder = TestDatabaseSeeder::class;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setSetting('users.password_change_firstlogin', false);
        $this->fillUsers();
    }

    public function test_admin_can_view_another_user(): void
    {
        $user = $this->getAdmin();
        $anotherUser = $this->userFactory();
        $response = $this->actingAs($user)->get(route('users.show', ['user' => $anotherUser->uuid]));

        $response->assertStatus(200);
    }
}
