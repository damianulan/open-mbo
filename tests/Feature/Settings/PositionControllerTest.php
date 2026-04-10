<?php

namespace Tests\Feature\Settings;

use App\Models\Business\Position;
use App\Models\Core\User;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class PositionControllerTest extends TestCase
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

    public function test_authenticated_user_can_store_position(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('settings.organization.positions.store'), [
            'name' => 'Software Engineer',
            'description' => 'Builds software',
        ]);

        $response->assertRedirect(route('settings.organization.positions.index'));
        $this->assertDatabaseHas('positions', [
            'name' => 'Software Engineer',
        ]);
    }

    public function test_authenticated_user_can_update_position(): void
    {
        $user = User::factory()->create();
        $position = Position::factory()->create([
            'name' => 'Developer',
        ]);

        $response = $this->actingAs($user)->put(route('settings.organization.positions.update', $position), [
            'name' => 'Senior Developer',
            'description' => $position->description,
        ]);

        $response->assertRedirect(route('settings.organization.positions.index'));
        $this->assertDatabaseHas('positions', [
            'id' => $position->id,
            'name' => 'Senior Developer',
        ]);
    }
}
