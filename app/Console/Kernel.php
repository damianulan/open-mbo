<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\AppRefresh;
use App\Console\Commands\AppReload;

use App\Console\Commands\MBO\CampaignStatusScript;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(new CampaignStatusScript())->daily()->at('00:01');

        if(config('backup.backup.auto') === true){
            $schedule->command('backup:run')->daily()->at('01:30');
        }

        if(config('app.env') === 'development'){
            $schedule->call(new AppRefresh())->daily()->at('01:01');
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
