<?php

namespace App\Events\MBO\Objectives;

use App\Models\MBO\UserObjective;
use App\Support\Notifications\Contracts\NotifiableEvent;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class UserObjectiveAssigned implements ShouldDispatchAfterCommit, NotifiableEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public UserObjective $userObjective
    ) {}

    public static function description(): string
    {
        return 'User objective assigned';
    }

    public function notifiable(): Model
    {
        return $this->userObjective->user;
    }

    public function checkConditions(): bool
    {
        return true;
    }

    public function notificationDelay(): int
    {
        return 0;
    }
}
