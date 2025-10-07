<?php

namespace App\Support\Notifications\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
}
