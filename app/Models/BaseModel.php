<?php

namespace App\Models;

use App\Traits\Vendors\ModelActivity;
use Carbon\Carbon;
use FormForge\Traits\RequestForms;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lucent\Support\Traits\Accessible;
use Lucent\Support\Traits\CascadeDeletes;
use Lucent\Support\Traits\SoftDeletesPrunable;
use Lucent\Support\Traits\UUID;
use Lucent\Support\Traits\VirginModel;
use Spatie\Activitylog\Models\Activity;
use YMigVal\LaravelModelCache\HasCachedQueries;

/**
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\BaseModel onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel updateQuietly(array $values)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\BaseModel withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\BaseModel withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\BaseModel withoutTrashed()
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
