<?php

namespace App\Console;

use App\Console\Commands\Core\AppRefresh;
use App\Console\Commands\Core\AppUpgrade;
use App\Console\Commands\MBO\MBOVerifyStatusScript;
use App\Support\Notifications\NotificationScheduler;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(MBOVerifyStatusScript::class)->dailyAt('01:01');

        if (true === config('backup.backup.auto')) {
            $schedule->command('backup:run')->daily()->at('01:30');
        }

        if (config('app.auto_update')) {
            $schedule->command(AppUpgrade::class)->everyOddHour();
        }

        if ('development' === config('app.env')) {

            if (env('CRON_APP_REFRESH', false)) {
                $schedule->command(AppRefresh::class)->daily()->at('00:00');
            }
        }

        // LARAVEL COMMANDS
        $schedule->command('telescope:prune')->dailyAt('00:01');
        $schedule->command('activitylog:clean')->dailyAt('00:01');
        $schedule->command('auth:clear-resets')->dailyAt('00:01');
        $schedule->command('model:prune')->dailyAt('00:01');
        $schedule->command('model:prune-soft-deletes')->dailyAt('00:01');

        // NOTIFICATIONS
        NotificationScheduler::load();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
