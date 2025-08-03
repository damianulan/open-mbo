<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use FormForge\Casts\TrixFieldCast;

/**
 * @property string $id
 * @property string $name
 * @property mixed|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments
 * @property-read int|null $employments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract withoutTrashed()
 * @property string $shortname
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract checkAccess()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract drafted()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereShortname($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|TypeOfContract withoutCache()
 * @mixin \Eloquent
 */
class TypeOfContract extends BaseModel
{
    public static $contracts = [
        'uop',
        'uz',
        'b2b',
        'uod',
    ];

    protected $fillable = [
        'name',
        'shortname',
        'description',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
    ];

    public static function findByShortname($name)
    {
        return self::where('shortname', $name)->first();
    }

    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }
}
