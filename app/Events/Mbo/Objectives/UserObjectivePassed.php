<?php

namespace App\Events\Mbo\Objectives;

use App\Models\Mbo\UserObjective;
use App\Support\Notifications\Contracts\NotifiableEvent;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserObjectivePassed implements NotifiableEvent, ShouldDispatchAfterCommit
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
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
