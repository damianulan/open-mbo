<?php

namespace App\Events\MBO\Objectives;

use App\Models\MBO\Objective;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ObjectiveCreated implements ShouldDispatchAfterCommit
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     * @param Objective $objective
     */
    public function __construct(
        public Objective $objective
    ) {}
}
