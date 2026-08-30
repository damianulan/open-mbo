<?php

namespace Tests\Feature\Mbo\Objective;

use App\Models\Mbo\Objective;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Tests\Traits\HasUserCollection;

class ObjectiveViewTest extends TestCase
{
    use HasUserCollection;
    use RefreshDatabase;

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

    public function test_objective_show_route_uses_uuid_binding(): void
    {
        $admin = $this->getAdminMbo();
        $objective = Objective::query()->create([
            'name' => 'UUID objective',
            'description' => '<p>Objective description</p>',
            'draft' => false,
            'weight' => 1,
            'award' => 10,
            'expected' => 100,
            'campaign_id' => null,
        ]);

        $response = $this->actingAs($admin)->get(route('objectives.show', $objective));

        $response->assertOk();
        $response->assertSee('UUID objective');
        $this->assertStringContainsString("/{$objective->uuid}", route('objectives.show', $objective));
        $this->assertNotSame(
            route('objectives.show', $objective->id),
            route('objectives.show', $objective),
        );
    }
}
