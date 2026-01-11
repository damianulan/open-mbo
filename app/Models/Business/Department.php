<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;
use Sentinel\Models\Role;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string $company_id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Collection<int, Department> $children
 * @property-read int|null $children_count
 * @property-read Company $company
 * @property-read Collection<int, UserEmployment> $employments
 * @property-read int|null $employments_count
 * @property-read Collection<int, User> $managers
 * @property-read int|null $managers_count
 * @property-read mixed $trans
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department drafted()
 * @method static \Database\Factories\Business\DepartmentFactory factory($count = null, $state = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department whereCompanyId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Department withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Department extends BaseModel
{
    protected $fillable = array(
        'company_id',
        'name',
        'description',
    );

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function managers(): MorphToMany
    {
        return $this->morphToMany(User::class, 'context', 'has_roles', null, 'model_id')->where('role_id', Role::getId('supervisor'));
    }

    public function employments(): HasMany
    {
        return $this->hasMany(UserEmployment::class);
    }
}
