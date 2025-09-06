<?php

namespace App\Console\Commands\MBO;

use App\Console\BaseCommand;
use App\Models\MBO\Campaign;
use App\Models\MBO\UserObjective;
use Illuminate\Database\Eloquent\Collection;
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
            $this->line('Updating campaigns status ...');
            Campaign::whereActive()->whereManual(0)->chunk(config('app.chunk_default'), function (Collection $campaigns) use ($echo) {
                foreach ($campaigns as $campaign) {
                    $campaign->setStageAuto();
                    if ($campaign->isDirty()) {
                        if ($echo) {
                            $this->line('Updating campaign status for: '.$campaign->name.' - '.$campaign->getOriginal('stage').' => '.$campaign->stage);
                        }
                        $campaign->updateQuietly();
                    }
                }
            });
            $this->line('Updating objectives status ...');
            UserObjective::whereNotEvaluated()->chunk(config('app.chunk_default'), function (Collection $objectives) use ($echo) {
                foreach ($objectives as $objective) {
                    $objective->setStatus();
                    if ($objective->isDirty()) {
                        if ($echo) {
                            $this->line('Updating objective status for: '.$objective->objective->name.' ('.$objective->user->name.') - '.$objective->getOriginal('status').' => '.$objective->status);
                        }
                        $objective->updateQuietly();
                    }
                }
            });
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->error($th->getMessage());
        }

        return true;
    }
}
