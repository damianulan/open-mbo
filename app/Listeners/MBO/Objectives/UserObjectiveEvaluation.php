<?php

namespace App\Listeners\MBO\Objectives;

use App\Events\MBO\Objectives\UserObjectiveEvaluated;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;

class UserObjectiveEvaluation implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;

    public $delay = 360;

    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(UserObjectiveEvaluated $event): void {}
}
