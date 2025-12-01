<?php

namespace App\Models\Business;

use App\Events\Core\User\EmploymentCreated;
use App\Events\Core\User\EmploymentDeleted;
use App\Events\Core\User\EmploymentUpdated;
use App\Models\BaseModel;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string $user_id
 * @property string|null $company_id
 * @property string|null $contract_id
 * @property string|null $department_id
 * @property string|null $position_id
 * @property Carbon|null $employment Date of employment
 * @property Carbon|null $release Date of employee release (end of employment)
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Company|null $company
 * @property-read TypeOfContract|null $contract
 * @property-read Department|null $department
 * @property-read bool $main
 * @property-read Position|null $position
 * @property-read mixed $trans
 * @property-read User $user
 *
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
 * @method static Builder<static>|UserEmployment onlyTrashed()
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
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment wherePositionId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereRelease($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment whereUserId($value)
 * @method static Builder<static>|UserEmployment withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserEmployment withoutCache()
 * @method static Builder<static>|UserEmployment withoutTrashed()
 *
 * @mixin \Eloquent
 */
class UserEmployment extends BaseModel
{
    protected $fillable = array(
        'user_id',
        'company_id',
        'contract_id',
        'department_id',
        'position_id',

        'employment',
        'release',
    );

    protected $casts = array(
        'employment' => 'date',
        'release' => 'date',
    );

    protected $dispatchesEvents = array(
        'created' => EmploymentCreated::class,
        'updated' => EmploymentUpdated::class,
        'deleted' => EmploymentDeleted::class,
    );

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function company(): ?BelongsTo
    {
        return $this->belongsTo(Company::class)->withTrashed();
    }

    public function contract(): ?BelongsTo
    {
        return $this->belongsTo(TypeOfContract::class, 'contract_id')->withTrashed();
    }

    public function department(): ?BelongsTo
    {
        return $this->belongsTo(Department::class)->withTrashed();
    }

    public function position(): ?BelongsTo
    {
        return $this->belongsTo(Position::class)->withTrashed();
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('user_employments.employment', '<', now())
            ->where(function (Builder $q): void {
                $q->whereNull('user_employments.release')
                    ->orWhere('user_employments.release', '>', now());
            });
    }

    protected static function booted(): void
    {
        static::addGlobalScope('order', function (Builder $builder): void {
            $builder->orderByDesc('employment');
        });
    }

    protected function main(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->id === UserEmployment::where('user_id', $this->user_id)->active()->first()->id,
        );
    }
}
