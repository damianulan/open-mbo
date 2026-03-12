<?php

namespace Tests\Feature\Settings;

use App\Http\Middleware\RouteGate;
use App\Models\Core\User;
use App\Models\Core\UserProfile;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class LogsTableRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        File::ensureDirectoryExists(storage_path('framework/cache/data'));
        Queue::fake();
        $this->seed(TestDatabaseSeeder::class);
        $this->setSetting('users.password_change_firstlogin', false);
        $this->setSetting('users.force_password_change_reset', false);
    }

    public function test_returns_settings_logs_datatable_payload_without_sql_errors(): void
    {
        $user = User::factory()->has(UserProfile::factory()->count(1), 'profile')->create();

        $this->actingAs($user);
        $this->withoutMiddleware(RouteGate::class);

        $response = $this->get(route('settings.logs.index'), [
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json',
        ]);

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'draw',
            'recordsTotal',
            'recordsFiltered',
            'data',
        ]);
        $response->assertJsonMissingPath('error');
    }
}
