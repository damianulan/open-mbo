<?php

namespace App\Commentable\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string $subject_type
 * @property string $subject_id
 * @property string $author_type
 * @property string $author_id
 * @property int|null $parent_id
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $author
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $responses
 * @property-read int|null $responses_count
 * @property-read Model|\Eloquent $subject
 * @method static Builder<static>|Comment direct()
 * @method static Builder<static>|Comment newModelQuery()
 * @method static Builder<static>|Comment newQuery()
 * @method static Builder<static>|Comment query()
 * @method static Builder<static>|Comment whereAuthorId($value)
 * @method static Builder<static>|Comment whereAuthorType($value)
 * @method static Builder<static>|Comment whereContent($value)
 * @method static Builder<static>|Comment whereCreatedAt($value)
 * @method static Builder<static>|Comment whereId($value)
 * @method static Builder<static>|Comment whereParentId($value)
 * @method static Builder<static>|Comment whereSubjectId($value)
 * @method static Builder<static>|Comment whereSubjectType($value)
 * @method static Builder<static>|Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use Searchable;

    protected $table = 'commentables';

    protected $fillable = [
        'subject_id',
        'subject_type',
        'author_id',
        'author_type',
        'parent_id',
        'content',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function author(): MorphTo
    {
        return $this->morphTo();
    }

    public function responses(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function isMine(): bool
    {
        return $this->author_id == Auth::user()->id && $this->author_type == Auth::user()->getMorphClass();
    }

    public function scopeMine(Builder $query): void
    {
        $query->where('author_id', Auth::user()->id)->where('author_type', Auth::user()->getMorphClass());
    }

    public function scopeDirect(Builder $query): void
    {
        $query->whereNull('parent_id');
    }
}
