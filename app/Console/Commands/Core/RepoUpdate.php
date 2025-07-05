<?php

namespace App\Console\Commands\Core;

use App\Console\BaseCommand;
use Illuminate\Support\Facades\Process;

class RepoUpdate extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:repoupdate {--branch=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating Repository with git and composer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->logStart();
        try {

            $branch = $this->option('branch');
            $result = Process::run('git fetch --all');
            $result = Process::run('git status');
            $this->info($result->output());
            if (! empty($branch)) {
                $result = Process::run('git switch '.$branch);
            }
            $result = Process::run('git pull origin');
            $this->info($result->output());
            $composer_exec = env('COMPOSER_EXECUTABLE', 'composer update');
            $result = Process::run($composer_exec);
            $this->info($result->output());
        } catch (\Throwable $th) {
            $this->log($th->getMessage(), false);
            $this->error($th->getMessage());
        }
    }
}
