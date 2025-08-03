<?php

namespace App\Console;

use App\Console\Commands\Core\AppRefresh;
use App\Console\Commands\Core\RepoUpdate;
use App\Console\Commands\Core\SystemTest;
use App\Console\Commands\MBO\MBOVerifyStatusScript;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(MBOVerifyStatusScript::class)->dailyAt('01:01');

        if (config('backup.backup.auto') === true) {
            $schedule->command('backup:run')->daily()->at('01:30');
        }

        $schedule->command(RepoUpdate::class)->everyFifteenMinutes();

        if (config('app.env') === 'development') {

            if (env('CRON_APP_REFRESH', false)) {
                $schedule->command(AppRefresh::class)->daily()->at('00:00');
            }
        }

        $runTest = env('CRON_RUN_TEST', false);
        if ($runTest) {
            $schedule->command(SystemTest::class)->everyMinute();
        }

        // LARAVEL COMMANDS
        $schedule->command('model:prune')->dailyAt('00:01');
        $schedule->command('telescope:prune')->dailyAt('00:01');
        $schedule->command('activitylog:clean')->dailyAt('00:01');
        $schedule->command('auth:clear-resets')->dailyAt('00:01');
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
