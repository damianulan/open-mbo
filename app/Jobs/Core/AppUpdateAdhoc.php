<?php

namespace App\Jobs\Core;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class AppUpdateAdhoc implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;

    public $timeout = 1200;

    public $tries = 2;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Artisan::call('app:upgrade');
    }
}
