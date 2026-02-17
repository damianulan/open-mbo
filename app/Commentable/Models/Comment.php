<?php

namespace App\Commentable\Models;

use App\Commentable\Casts\CommentContent;
use App\Commentable\Events\CommentAdded;
use App\Commentable\Events\CommentDeleted;
use App\Traits\Vendors\ModelActivity;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use YMigVal\LaravelModelCache\HasCachedQueries;

/**
 * @property int $id
 * @property string $subject_type
 * @property string $subject_id
 * @property string $author_type
 * @property string $author_id
 * @property mixed $content
 * @property bool $private
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Model|\Eloquent $author
 * @property-read Model|\Eloquent $subject
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment authoredBy(\Illuminate\Database\Eloquent\Model $author)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment mine()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment newQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment whereAuthorId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment whereAuthorType($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment whereContent($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment wherePrivate($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment whereSubjectId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment whereSubjectType($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Comment withoutCache()
 * @mixin Eloquent
 */
class Comment extends Model
{
    use HasCachedQueries;
    use MassPrunable;
    use ModelActivity;

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
        'deleted' => CommentDeleted::class,
    ];

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
        return $this->author_id === Auth::user()->id && $this->author_type === Auth::user()->getMorphClass();
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
        return static::whereHas('subject', function (Builder $query): void {
            $query->whereNotNull('deleted_at');
        })->orWhereHas('author', function (Builder $query): void {
            $query->whereNotNull('deleted_at');
        });
    }

    protected static function booted(): void
    {
        $user = Auth::user() ?? null;
        if ($user) {
            $id = $user->id ?? null;
            $morph = $user->getMorphClass() ?? null;
            if ($id && $morph) {
                static::addGlobalScope('public', function (Builder $builder) use ($id, $morph): void {
                    $builder->where(function (Builder $query) use ($id, $morph): void {
                        $query->where('private', 0)
                            ->orWhere(function (Builder $query) use ($id, $morph): void {
                                $query->where('author_id', $id)
                                    ->where('author_type', $morph);
                            });
                    });
                });
            }
        }
    }
}
