<?php

namespace App\Console\Commands\Core;

use App\Console\BaseCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;
use Throwable;

class AppRefresh extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh {--branch=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rerolling whole application and updating repository data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->logStart();
        try {
            $notLocal = 'local' !== config('app.env');

            if ($notLocal) {
                $branch = $this->option('branch');
                $result = Process::run('git status');
                $this->info($result->output());
                $result = Process::run('git reset --hard');
                $this->info($result->output());
                if ( ! empty($branch)) {
                    $result = Process::run('git switch ' . $branch);
                }
                $result = Process::run('git pull origin');
                $this->info($result->output());
            }

            Artisan::call('db:wipe');
            $this->info(Artisan::output());
            Artisan::call('migrate --seed');
            $this->info(Artisan::output());
            Artisan::call('optimize:clear');
            Artisan::call(MailTest::class);
            $this->info(Artisan::output());
            Artisan::call('optimize:clear');
            $this->info(Artisan::output());

            $this->log('completed', true);
        } catch (Throwable $th) {
            $this->log($th->getMessage(), false);
            $this->error($th->getMessage());
        }
    }
}
