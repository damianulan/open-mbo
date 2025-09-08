<?php

namespace App\Console\Commands\Core;

use App\Support\Notifications\SendNotificationsJob;
use Illuminate\Console\Command;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatches Job sending recurring notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            SendNotificationsJob::dispatch();
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }
    }
}
