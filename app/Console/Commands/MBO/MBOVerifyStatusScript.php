<?php

namespace App\Console\Commands\MBO;

use App\Console\BaseCommand;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserObjective;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

class MBOVerifyStatusScript extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mbo:statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User enrolled to Campaigns and Objectives status update';

    /**
     * Execute the console command.
     */
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
                    $campaign->setStageAuto();
                    if ($campaign->isDirty('stage')) {
                        if ($echo) {
                            $this->line('Updating campaign status for: ' . $campaign->name . ' - ' . $campaign->getOriginal('stage') . ' => ' . $campaign->stage);
                        }
                        $campaign->updateQuietly();
                    }

                    $campaign->setUserStage();
                }
            });
            $this->line('Updating objectives status ...');
            UserObjective::whereNotEvaluated()->whereHas('objective')->chunk(config('app.chunk_default'), function (Collection $objectives) use ($echo): void {
                foreach ($objectives as $objective) {
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
            $this->error($th->getMessage());
        }

        return true;
    }
}
