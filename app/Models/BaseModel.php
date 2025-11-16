<?php

namespace App\Models;

use App\Traits\Vendors\ModelActivity;
use Carbon\Carbon;
use FormForge\Traits\RequestForms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lucent\Support\Traits\Accessible;
use Lucent\Support\Traits\CascadeDeletes;
use Lucent\Support\Traits\SoftDeletesPrunable;
use Lucent\Support\Traits\UUID;
use Lucent\Support\Traits\VirginModel;
use YMigVal\LaravelModelCache\HasCachedQueries;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel updateQuietly(array $values)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|BaseModel withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel withoutTrashed()
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use Accessible, CascadeDeletes, HasCachedQueries, HasFactory, ModelActivity, RequestForms, SoftDeletes, SoftDeletesPrunable, UUID, VirginModel;

    public function carbonDate(string $prop, string $format = 'Y-m-d')
    {
        $date = $this->{$prop};
        $date_carbon = null;
        if ($date) {
            $date_carbon = Carbon::parse($date)->format($format);
        }

        return $date_carbon;
    }
}
