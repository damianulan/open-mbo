<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Artisan;

class AppRefresh extends Command
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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $branch = $this->option('branch');
        $result = Process::run('git status');
        $this->info($result->output());
        if(!empty($branch)){
            $result = Process::run('git switch '.$branch);
        }
        $result = Process::run('git pull origin');
        $this->info($result->output());
        Artisan::call('db:wipe');
        $this->info(Artisan::output());
        Artisan::call('migrate --seed');
        $this->info(Artisan::output());

    }
}
