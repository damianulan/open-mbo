<?php

namespace App\Events\MBO\Objectives;

use App\Models\Core\User;
use App\Models\MBO\UserObjective;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserObjectiveEvaluated implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public UserObjective $userObjective,
        public ?User $evaluator,
    ) {
        //
    }
}
