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

    public function test_user_can_view_another_user(): void
    {
        $user = $this->userFactory();
        $anotherUser = $this->userFactory();
        $response = $this->actingAs($user)->get(route('users.show', $anotherUser));

        $response->assertStatus(200);
    }
}
