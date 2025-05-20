<?php

namespace App\Console\Commands\MBO;

use App\Console\BaseCommand;
use App\Models\MBO\Campaign;
use App\Enums\MBO\CampaignStage;

class CampaignStatusScript extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mbo:campaign-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User enrolled to Campaigns status update';

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
        $campaigns = Campaign::whereActive()->whereManual(0)->get();

        if (!empty($campaigns)) {
            foreach ($campaigns as $campaign) {
                if ($echo) {
                    $this->info('Updating campaign status for: ' . $campaign->name);
                }
                $campaign->timestamps = false;
                $campaign->setStageAuto();
                $campaign->update();
            }

            $this->info('Campaign statuses updated successfully');
        }
    }
}
