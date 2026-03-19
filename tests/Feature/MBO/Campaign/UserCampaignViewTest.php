<?php

namespace Tests\Feature\MBO\Campaign;

use App\Enums\MBO\CampaignStage;
use App\Enums\MBO\UserObjectiveStatus;
use App\Models\MBO\Objective;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\UserObjective;
use Database\Seeders\TestDatabaseSeeder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\Traits\HasUserCollection;

class UserCampaignViewTest extends TestCase
{
    use RefreshDatabase;
    use HasUserCollection;

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

    public function test_user_campaign_completion_chart_uses_valid_series_values(): void
    {
        $completedObjective = new UserObjective([
            'status' => UserObjectiveStatus::COMPLETED->value,
        ]);
        $completedObjective->setRelation('objective', new Objective([
            'weight' => 1,
        ]));

        $openObjective = new UserObjective([
            'status' => UserObjectiveStatus::PROGRESS->value,
        ]);
        $openObjective->setRelation('objective', new Objective([
            'weight' => 1,
        ]));

        $userCampaign = new UserCampaign([
            'stage' => CampaignStage::IN_PROGRESS,
        ]);
        $userCampaign->setRelation('user_objectives', new EloquentCollection([
            $completedObjective,
            $openObjective,
        ]));

        $chartOptions = $userCampaign->chart('user_campaign_completion')->getOptions();

        $this->assertTrue(Str::contains($chartOptions, '"series":[1,1]'));
    }
}
