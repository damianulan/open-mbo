<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string|null $foreign_id
 * @property string $user_id
 * @property string $company_id
 * @property string $contract_id
 * @property string $department_id
 * @property string $position_id
 * @property \Illuminate\Support\Carbon $employment
 * @property \Illuminate\Support\Carbon|null $release
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Business\Company $company
 * @property-read \App\Models\Business\TypeOfContract $contract
 * @property-read \App\Models\Business\Department $department
 * @property-read \App\Models\Business\Position $position
 * @property-read User $user
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereCompanyId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereContractId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereDepartmentId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereEmployment($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereForeignId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment wherePositionId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereRelease($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment withoutTrashed()
 * @mixin \Eloquent
 */
class UserEmployment extends BaseModel
{
    protected $fillable = [
        'user_id',
        'company_id',
        'contract_id',
        'department_id',
        'position_id',

        'employment',
        'release',
    ];

    protected $casts = [
        'employment' => 'date',
        'release' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(TypeOfContract::class, 'contract_id')->withTrashed();
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class)->withTrashed();
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class)->withTrashed();
    }

    public function team() {}
}
