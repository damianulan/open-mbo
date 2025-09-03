<?php

namespace App\Commentable\Support;

use App\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Commentable
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'subject');
    }

    public function comments_direct(): MorphMany
    {
        return $this->morphMany(Comment::class, 'subject')->direct();
    }
}
