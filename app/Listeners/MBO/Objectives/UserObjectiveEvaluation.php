<?php

namespace App\Listeners\MBO\Objectives;

use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\MBO\Objectives\UserObjectiveEvaluated;

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
