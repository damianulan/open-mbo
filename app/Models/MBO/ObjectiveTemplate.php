<?php

namespace App\Models\MBO;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\Scopes\MBO\ObjectiveTemplateScope;

/**
 * @property string $id
 * @property string|null $category_id
 * @property string $name
 * @property mixed|null $description
 * @property string|null $award Max points to be awarded for objective completion
 * @property bool $draft
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\MBO\ObjectiveTemplateCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\Objective> $objectives
 * @property-read int|null $objectives_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate drafted()
 * @method static \Database\Factories\MBO\ObjectiveTemplateFactory factory($count = null, $state = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate whereAward($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate whereCategoryId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate whereDraft($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplate withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate withoutTrashed()
 *
 * @mixin \Eloquent
 */
class ObjectiveTemplate extends BaseModel
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'award',
    ];

    protected $casts = [
        'description' => FormattedText::class,
        'draft' => 'boolean',
    ];

    protected $accessScope = ObjectiveTemplateScope::class;

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
            $model->objective_templates()->delete();
        });
    }

    public function category()
    {
        return $this->belongsTo(ObjectiveTemplateCategory::class, 'category_id');
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class, 'template_id');
    }

    public function coordinators()
    {
        return $this->category->coordinators();
    }

    public function usersCount(): int
    {
        $result = 0;
        if ($this->objectives) {
            foreach ($this->objectives as $objective) {
                $result += $objective->user_assignments()->count();
            }
        }

        return $result;
    }

    public function campaignsCount(): int
    {
        return $this->objectives()->whereNotNull('campaign_id')->count();
    }

    public function global(): bool
    {
        return $this->category()->global ? true : false;
    }

    public function assign(User $user): bool
    {
        $objective = new Objective;
        $objective->template_id = $this->id;
        $objective->user_id = $user->id;
        $objective->name = $this->name;
        $objective->description = $this->description;
        $objective->draft = 1;
        $objective->award = $this->award;

        return $objective->save() ? true : false;
    }
}
