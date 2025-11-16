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
 * @property \Illuminate\Support\Carbon|null $employment Date of employment
 * @property \Illuminate\Support\Carbon|null $release Date of employee release (end of employment)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Company|null $company
 * @property-read TypeOfContract|null $contract
 * @property-read Department|null $department
 * @property-read bool $main
 * @property-read \App\Models\Business\Position|null $position
 * @property-read \App\Models\Core\User $user
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\UserEmployment onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereCompanyId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereContractId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereDepartmentId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereEmployment($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment wherePositionId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereRelease($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\UserEmployment withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\Business\UserEmployment withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\Business\UserEmployment withoutTrashed()
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
            get: fn(): bool => $this->id === UserEmployment::where('user_id', $this->user_id)->active()->first()->id,
        );
    }
}
