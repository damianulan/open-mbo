<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments
 * @property-read int|null $employments_count
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\TypeOfContract onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\TypeOfContract withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\TypeOfContract withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\TypeOfContract withoutTrashed()
 * @mixin \Eloquent
 */
class TypeOfContract extends BaseModel
{
    public static $contracts = array(
        'uop',
        'uz',
        'b2b',
        'uod',
    );

    protected $fillable = array(
        'name',
        'shortname',
        'description',
    );

    public static function findByShortname($name): ?self
    {
        return self::where('shortname', $name)->first();
    }

    public function employments(): HasMany
    {
        return $this->hasMany(UserEmployment::class);
    }
}
