<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\Core\AppRefresh;
use App\Console\Commands\Core\SystemTest;
use App\Console\Commands\Core\RepoUpdate;

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
        $schedule->command(CampaignStatusScript::class)->everyThirtyMinutes();

        if (config('backup.backup.auto') === true) {
            $schedule->command('backup:run')->daily()->at('01:30');
        }

        if (config('app.env') === 'development') {
            $schedule->command(RepoUpdate::class)->hourlyAt(0);

            if (env('CRON_APP_REFRESH', false)) {
                $schedule->command(AppRefresh::class)->daily()->at('00:00');
            }
        }

        $runTest = env('CRON_RUN_TEST', false);
        if ($runTest) {
            $schedule->command(SystemTest::class)->everyMinute();
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
