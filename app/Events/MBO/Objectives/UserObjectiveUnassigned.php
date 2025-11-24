<?php

namespace App\Events\MBO\Objectives;

use App\Models\MBO\UserObjective;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use App\Support\Notifications\Contracts\NotifiableEvent;

class UserObjectiveUnassigned implements ShouldDispatchAfterCommit, NotifiableEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public UserObjective $userObjective,
    ) {}

    public static function description(): string
    {
        return 'User objective unassigned';
    }

    public function notifiable(): Model
    {
        return $this->userObjective->user;
    }
}
