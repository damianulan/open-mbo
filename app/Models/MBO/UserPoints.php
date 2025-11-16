<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string $user_id
 * @property string $subject_type
 * @property string $subject_id
 * @property string|null $points
 * @property string|null $assigned_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Core\User|null $assigner
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 * @property-read \App\Models\Core\User $user
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\UserPoints onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints whereAssignedBy($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints wherePoints($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints whereSubjectId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints whereSubjectType($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\UserPoints withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserPoints withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\UserPoints withoutTrashed()
 * @mixin \Eloquent
 */
class UserPoints extends BaseModel
{
    protected $fillable = array(
        'user_id',
        'subject_id',
        'subject_type',
        'points',
        'assigned_by',
    );

    public function subject(): MorphTo
    {
        return $this->morphTo('subject', 'subject_type');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function assigner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by')->withTrashed();
    }
}
