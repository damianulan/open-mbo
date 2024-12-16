<?php

namespace App\Console\Commands\MBO;

use Illuminate\Console\Command;
use App\Models\MBO\Campaign;
use App\Enums\MBO\CampaignStage;

class CampaignStatusScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:campaign-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $campaigns = Campaign::where(['manual' => 0, 'draft' => 0])
                        ->whereIn('stage', [CampaignStage::PENDING->value, CampaignStage::IN_PROGRESS->value])
                        ->get();

        if(!empty($campaigns)){
            foreach($campaigns as $campaign){
                $this->info('Updating campaign status for: ' . $campaign->name);
                $campaign->timestamps = false;
                $campaign->setStageAuto();
                $campaign->update();
                $campaign->setUserStage();
            }
        }
    }
}
