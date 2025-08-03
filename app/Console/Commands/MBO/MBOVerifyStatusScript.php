<?php

namespace App\Console\Commands\MBO;

use App\Console\BaseCommand;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserObjective;
use Illuminate\Support\Facades\DB;

class MBOVerifyStatusScript extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mbo:statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User enrolled to Campaigns and Objectives status update';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->logStart();
        try {
            $this->campaignsSetStatus();
            $this->log('completed', true);
        } catch (\Throwable $th) {
            $this->log($th->getMessage(), false);
            $this->error($th->getMessage());
        }
    }

    public function campaignsSetStatus(bool $echo = true)
    {
        try {
            DB::beginTransaction();
            $campaigns = Campaign::whereActive()->whereManual(0)->get()->each(function (Campaign $campaign) use ($echo) {
                $campaign->timestamps = false;
                $campaign->setStageAuto();
                if ($campaign->isDirty()) {
                    if ($echo) {
                        $this->line('Updating campaign status for: ' . $campaign->name . ' - ' . $campaign->getOriginal('stage') . ' => ' . $campaign->stage);
                    }
                    $campaign->update();
                }
            });
            $userObjectives = UserObjective::whereNotEvaluated()->get()->each(function (UserObjective $objective) use ($echo) {
                $objective->timestamps = false;
                $objective->setStatus();
                if ($objective->isDirty()) {
                    if ($echo) {
                        $this->line('Updating objective status for: ' . $objective->objective->name . ' (' . $objective->user->name . ') - ' . $objective->getOriginal('status') . ' => ' . $objective->status);
                    }
                    $objective->update();
                }
            });
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->error($th->getMessage());
        }
    }
}
