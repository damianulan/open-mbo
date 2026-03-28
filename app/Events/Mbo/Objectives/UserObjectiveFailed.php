<?php

namespace App\Events\Mbo\Objectives;

use App\Models\Mbo\UserObjective;
use App\Support\Notifications\Contracts\NotifiableEvent;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserObjectiveFailed implements NotifiableEvent, ShouldDispatchAfterCommit
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public UserObjective $userObjective,
    ) {}

    public static function description(): string
    {
        return 'User objective failed';
    }

    public function notifiable(): Model
    {
        return $this->userObjective->user;
    }

    public function checkConditions(): bool
    {
        return $this->userObjective->isFailed();
    }

    public function notificationDelay(): int
    {
        return 60;
    }
}
