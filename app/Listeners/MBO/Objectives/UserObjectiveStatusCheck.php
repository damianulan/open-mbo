<?php

namespace App\Listeners\MBO\Objectives;

use App\Events\MBO\Objectives\ObjectiveCreated;
use App\Events\MBO\Objectives\ObjectiveUpdated;
use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Illuminate\Queue\InteractsWithQueue;

class UserObjectiveStatusCheck implements ShouldQueueAfterCommit
{
    use InteractsWithQueue;

    public $timeout = 180;

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
    public function handle(ObjectiveCreated|ObjectiveUpdated $event): void
    {
        $objective = $event->objective;

        if ($objective->isDirty('deadline')) {
            $userObjectives = $objective->user_objectives()->whereNotEvaluated()->get();
            foreach ($userObjectives as $userObjective) {
                $userObjective->setStatus()->update();
            }
        }
    }
}
