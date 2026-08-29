<?php

namespace Tests\Feature\Routing;

use App\Enums\Mbo\CampaignStage;
use App\Enums\Mbo\UserObjectiveStatus;
use App\Models\Business\Company;
use App\Models\Core\User;
use App\Models\Mbo\Campaign;
use App\Models\Mbo\Objective;
use App\Models\Mbo\UserCampaign;
use App\Models\Mbo\UserObjective;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Tests\Traits\HasUserCollection;

class UuidRouteBindingTest extends TestCase
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

    public function test_uuid_route_helpers_are_generated_for_unique_uuid_models(): void
    {
        $user = User::factory()->create();
        $campaign = Campaign::query()->create([
            'name' => ['en' => 'UUID Campaign'],
            'period' => '2026 Q2',
            'description' => '<p>Campaign description</p>',
            'definition_from' => now()->startOfDay(),
            'definition_to' => now()->addDay()->endOfDay(),
            'disposition_from' => now()->addDays(2)->startOfDay(),
            'disposition_to' => now()->addDays(3)->endOfDay(),
            'realization_from' => now()->addDays(4)->startOfDay(),
            'realization_to' => now()->addDays(5)->endOfDay(),
            'evaluation_from' => now()->addDays(6)->startOfDay(),
            'evaluation_to' => now()->addDays(7)->endOfDay(),
            'self_evaluation_from' => now()->addDays(8)->startOfDay(),
            'self_evaluation_to' => now()->addDays(9)->endOfDay(),
            'draft' => false,
            'manual' => false,
        ]);
        $company = Company::factory()->create();

        $objective = Objective::query()->create([
            'name' => 'Routed objective',
            'description' => '<p>Objective description</p>',
            'draft' => false,
            'weight' => 1,
            'award' => 10,
            'expected' => 100,
        ]);

        $userCampaign = UserCampaign::query()->create([
            'campaign_id' => $campaign->id,
            'user_id' => $user->id,
            'stage' => CampaignStage::IN_PROGRESS,
            'manual' => false,
            'active' => true,
        ]);

        $userObjective = UserObjective::query()->create([
            'user_id' => $user->id,
            'objective_id' => $objective->id,
            'status' => UserObjectiveStatus::PROGRESS->value,
            'evaluation' => 50,
        ]);

        $this->assertStringContainsString("/{$user->uuid}", route('users.show', ['user' => $user->uuid]));
        $this->assertStringContainsString("/{$campaign->uuid}", route('campaigns.show', ['campaign' => $campaign->uuid]));
        $this->assertStringContainsString("/{$company->uuid}", route('settings.organization.company.edit', $company));
        $this->assertStringContainsString("/{$userCampaign->uuid}", route('campaigns.users.show', ['userCampaign' => $userCampaign->uuid]));
        $this->assertStringContainsString("/{$userObjective->uuid}", route('objectives.assignment.show', $userObjective));
    }
}
