<?php

namespace App\Events\MBO\Objectives;

use App\Models\MBO\UserObjective;
use App\Support\Notifications\Contracts\NotifiableEvent;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserObjectivePassed implements ShouldDispatchAfterCommit, NotifiableEvent
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     * @param UserObjective $userObjective
     */
    public function __construct(
        public UserObjective $userObjective
    ) {}

    public static function description(): string
    {
        return 'User objective passed';
    }

    public function notifiable(): Model
    {
        return $this->userObjective->user;
    }

    public function checkConditions(): bool
    {
        return $this->userObjective->isPassed();
    }

    public function notificationDelay(): int
    {
        return 60;
    }
}
