<?php

namespace App\Listeners\MBO\Objectives;

use App\Events\MBO\Objectives\UserObjectiveEvaluated;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;

class UserObjectiveStatusCheck implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;

    public $delay = 300;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserObjectiveEvaluated $event): void {}
}
