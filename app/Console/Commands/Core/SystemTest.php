<?php

namespace App\Console\Commands\Core;

use Illuminate\Console\Command;
use App\Settings\MailSettings;
use Illuminate\Support\Facades\Mail;

class SystemTest extends Command
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
        activity()->log('cron system test');
        $this->info('Cron system test');
    }
}
