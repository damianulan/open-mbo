<?php

namespace App\Models\MBO;

use App\Models\BaseModel;

/**
 * @property int $id
 * @property string $user_id
 * @property string $subject_type
 * @property string $subject_id
 * @property string|null $points
 * @property string $assigned_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints whereAssignedBy($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints wherePoints($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints whereSubjectId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints whereSubjectType($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserPoints withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints withoutTrashed()
 * @mixin \Eloquent
 */
class UserPoints extends BaseModel
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'subject_type',
        'points',
        'assigned_by',
    ];
}
