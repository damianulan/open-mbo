<?php

namespace App\Events\MBO\Objectives;

use App\Models\Core\User;
use App\Models\MBO\UserObjective;
use App\Support\Notifications\Contracts\NotifiableEvent;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class UserObjectiveFailed implements ShouldDispatchAfterCommit, NotifiableEvent
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public UserObjective $userObjective,
        public ?User $evaluator,
    ) {}

    public static function description(): string
    {
        return 'User objective failed';
    }

    public function notifiable(): Model
    {
        return $this->userObjective->user;
    }
}
