<?php

namespace App\Console\Commands\Mbo;

use App\Console\BaseCommand;
use App\Enums\Mbo\CampaignStage;
use App\Models\Mbo\Campaign;
use App\Models\Mbo\UserObjective;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class MboVerifyStatusScript extends BaseCommand
{
    /**
     * @var string
     */
    protected $signature = 'app:mbo:statuses';

    /**
     * @var string
     */
    protected $description = 'User enrolled to Campaigns and Objectives status update';

    public function handle(): void
    {
        $this->logStart();

        try {
            $this->campaignsSetStatus();
            $this->log('completed', true);
        } catch (Throwable $th) {
            $this->log($th->getMessage(), false);
            $this->error($th->getMessage());
        }
    }

    public function campaignsSetStatus(bool $echo = true)
    {
        try {
            DB::beginTransaction();
            $this->line('Updating campaigns status ...');
            Campaign::whereActive()->whereManual(0)->chunk(config('app.chunk_default'), function (Collection $campaigns) use ($echo): void {
                foreach ($campaigns as $campaign) {
                    /** @var Campaign $campaign */
                    $campaign->setStageAuto();
                    if ($campaign->isDirty('stage')) {
                        if ($echo) {
                            $originalStage = CampaignStage::getName($campaign->getOriginal('stage'));
                            $currentStage = CampaignStage::getName($campaign->stage);

                            $this->line("Updating campaign status for: {$campaign->name} - {$originalStage} => {$currentStage}");
                        }
                        $campaign->updateQuietly();
                    }

                    $campaign->setUserStage();
                }
            });
            $this->line('Updating objectives status ...');
            UserObjective::whereNotEvaluated()->whereHas('objective')->chunk(config('app.chunk_default'), function (Collection $objectives) use ($echo): void {
                foreach ($objectives as $objective) {
                    /** @var UserObjective $objective */
                    $objective->setStatus();
                    if ($objective->isDirty('status')) {
                        if ($echo) {
                            $this->line('Updating objective status for: ' . $objective->objective->name . ' (' . $objective->user->name . ') - ' . $objective->getOriginal('status') . ' => ' . $objective->status);
                        }
                        $objective->update();
                    }
                }
            });
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();

            throw $th;
        }

        return true;
    }
}
