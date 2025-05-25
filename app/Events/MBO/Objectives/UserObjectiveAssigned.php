<?php

namespace App\Events\MBO\Objectives;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Core\User;
use App\Models\MBO\Objective;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class UserObjectiveAssigned implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user,
        public Objective $objective
    ) {
        //
    }
}
