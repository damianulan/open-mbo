<?php

namespace App\Commentable\Support;

use App\Commentable\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Commentator
{
    public function my_comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'author');
    }

    public function getAvatarView(int $height = 70, int $width = 70): string
    {
        return '';
    }

    public function routeShow(): string
    {
        return url('/');
    }
}
