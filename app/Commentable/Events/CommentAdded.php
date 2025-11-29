<?php

namespace App\Commentable\Events;

use App\Commentable\Models\Comment;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommentAdded implements ShouldDispatchAfterCommit
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new event instance.
     * @param Comment $comment
     */
    public function __construct(
        public Comment $comment
    ) {}
}
