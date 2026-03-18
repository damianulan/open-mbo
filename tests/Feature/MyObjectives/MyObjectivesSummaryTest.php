<?php

namespace Tests\Feature\MyObjectives;

use App\Enums\MBO\CampaignStage;
use App\Enums\MBO\UserObjectiveStatus;
use App\Models\Core\User;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\UserObjective;
use App\Models\MBO\UserPoints;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class MyObjectivesSummaryTest extends TestCase
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

    public function test_authenticated_user_can_view_my_objectives_summary(): void
    {
        $user = User::factory()->create();

        $campaign = Campaign::factory()->create([
            'name' => 'My Campaign',
        ]);

        $userCampaign = UserCampaign::query()->create([
            'campaign_id' => $campaign->id,
            'user_id' => $user->id,
            'stage' => CampaignStage::IN_PROGRESS,
            'manual' => false,
            'active' => true,
        ]);

        $objective = Objective::query()->create([
            'name' => 'My Objective',
            'description' => '<p>Objective description</p>',
            'draft' => false,
            'weight' => 1,
            'award' => 10,
            'expected' => 100,
            'campaign_id' => null,
        ]);

        $userObjective = UserObjective::query()->create([
            'user_id' => $user->id,
            'objective_id' => $objective->id,
            'status' => UserObjectiveStatus::PROGRESS,
            'evaluation' => 50,
        ]);

        UserPoints::query()->create([
            'user_id' => $user->id,
            'subject_id' => $userObjective->id,
            'subject_type' => UserObjective::class,
            'points' => 5,
            'assigned_by' => null,
        ]);

        $response = $this->actingAs($user)->get(route('my-objectives.index'));

        $response->assertOk();
        $response->assertSee('My Objective');
        $response->assertSee('My Campaign');
        $response->assertSee((string) $userCampaign->id);
        $response->assertSee(float_view(5.0) . ' / ' . float_view(10.0) . __('globals.pnts'));
    }
}
