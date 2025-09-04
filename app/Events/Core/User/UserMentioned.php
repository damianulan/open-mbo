<?php

namespace App\Events\Core\User;

use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\User;

class UserMentioned implements ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $user,
        public Model $context,
        public User $mentionedBy
    ) {}
}
