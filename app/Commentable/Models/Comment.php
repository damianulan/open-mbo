<?php

namespace App\Commentable\Models;

use App\Commentable\Casts\CommentContent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;
use App\Commentable\Events\CommentDeleted;
use App\Commentable\Events\CommentAdded;
use App\Traits\Vendors\ModelActivity;
use Illuminate\Database\Eloquent\MassPrunable;
use YMigVal\LaravelModelCache\HasCachedQueries;

/**
 * @property int $id
 * @property string $subject_type
 * @property string $subject_id
 * @property string $author_type
 * @property string $author_id
 * @property mixed $content
 * @property bool $private
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $author
 * @property-read Model|\Eloquent $subject
 *
 * @method static Builder<static>|Comment authoredBy(\Illuminate\Database\Eloquent\Model $author)
 * @method static Builder<static>|Comment mine()
 * @method static Builder<static>|Comment newModelQuery()
 * @method static Builder<static>|Comment newQuery()
 * @method static Builder<static>|Comment query()
 * @method static Builder<static>|Comment whereAuthorId($value)
 * @method static Builder<static>|Comment whereAuthorType($value)
 * @method static Builder<static>|Comment whereContent($value)
 * @method static Builder<static>|Comment whereCreatedAt($value)
 * @method static Builder<static>|Comment whereId($value)
 * @method static Builder<static>|Comment wherePrivate($value)
 * @method static Builder<static>|Comment whereSubjectId($value)
 * @method static Builder<static>|Comment whereSubjectType($value)
 * @method static Builder<static>|Comment whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use Searchable, ModelActivity, HasCachedQueries, MassPrunable;

    protected $table = 'commentables';

    protected $fillable = [
        'subject_id',
        'subject_type',
        'author_id',
        'author_type',
        'content',
        'private',
    ];

    protected $casts = [
        'content' => CommentContent::class,
        'private' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'created' => CommentAdded::class,
        'deleted' => CommentDeleted::class
    ];

    protected static function booted(): void
    {
        $user = Auth::user() ?? null;
        if ($user) {
            $id = $user->id ?? null;
            $morph = $user->getMorphClass() ?? null;
            if ($id && $morph) {
                static::addGlobalScope('public', function (Builder $builder) use ($id, $morph) {
                    $builder->where(function (Builder $query) use ($id, $morph) {
                        $query->where('private', 0)
                            ->orWhere(function (Builder $query) use ($id, $morph) {
                                $query->where('author_id', $id)
                                    ->where('author_type', $morph);
                            });
                    });
                });
            }
        }
    }

    public function subject(): MorphTo
    {
        return $this->morphTo()->withTrashed();
    }

    public function author(): MorphTo
    {
        return $this->morphTo()->withTrashed();
    }

    public function isMine(): bool
    {
        return $this->author_id == Auth::user()->id && $this->author_type == Auth::user()->getMorphClass();
    }

    public function scopeAuthoredBy(Builder $query, Model $author): void
    {
        $query->where('author_id', $author->id)->where('author_type', $author->getMorphClass());
    }

    public function scopeMine(Builder $query): void
    {
        $query->where('author_id', Auth::user()->id)->where('author_type', Auth::user()->getMorphClass());
    }

    public function prunable(): Builder
    {
        return static::whereHas('subject', function (Builder $query) {
            $query->whereNotNull('deleted_at');
        })->orWhereHas('author', function (Builder $query) {
            $query->whereNotNull('deleted_at');
        });
    }
}
