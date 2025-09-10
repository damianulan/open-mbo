<?php

namespace App\Console\Commands\Core;

use App\Console\BaseCommand;

class SystemTest extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cron-test';

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
        $this->logStart();
        $this->info('Cron system test');
        $this->log('completed', true);
    }
}
