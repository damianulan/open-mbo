<?php

namespace App\Models\MBO;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\Scopes\MBO\ObjectiveTemplateCategoryScope;

/**
 * @property string $id
 * @property string $name
 * @property string|null $shortname
 * @property mixed|null $description
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $coordinators
 * @property-read int|null $coordinators_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\ObjectiveTemplate> $objective_templates
 * @property-read int|null $objective_templates_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory whereIcon($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory whereShortname($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|ObjectiveTemplateCategory withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory withoutTrashed()
 *
 * @mixin \Eloquent
 */
class ObjectiveTemplateCategory extends BaseModel
{
    protected $table = 'objective_template_categories';

    protected $fillable = [
        'name',
        'shortname',
        'description',
        'icon',
    ];

    protected $casts = [
        'description' => FormattedText::class,
    ];

    protected $accessScope = ObjectiveTemplateCategoryScope::class;

    protected static function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
            $model->objective_templates()->delete();
            $model->coordinators()->delete();
        });
    }

    public static function findByShortname(string $shortname): ?self
    {
        return self::where('shortname', $shortname)->first();
    }

    public static function baseCategories(): array
    {
        return [
            'global',
            'audit',
            'individual',
        ];
    }

    public function canBeDeleted(): bool
    {
        return ! in_array($this->shortname, self::baseCategories());
    }

    public function coordinators()
    {
        return $this->morphToMany(User::class, 'context', 'has_roles', null, 'model_id');
    }

    public function refreshCoordinators(?array $user_ids)
    {
        if (! $user_ids) {
            $user_ids = [];
        }

        $current = $this->coordinators->pluck('id')->toArray();
        $toDelete = array_filter($current, function ($value) use ($user_ids) {
            return ! in_array($value, $user_ids);
        });
        $toAdd = array_filter($user_ids, function ($value) use ($current) {
            return ! in_array($value, $current);
        });

        foreach ($toDelete as $user_id) {
            $user = User::find($user_id);
            if ($user->exists()) {
                $user->revokeRoleSlug('objective_coordinator', $this);
            }
        }
        foreach ($toAdd as $user_id) {
            $user = User::find($user_id);
            if ($user->exists()) {
                $user->assignRoleSlug('objective_coordinator', $this);
            }
        }
    }

    public function objective_templates()
    {
        return $this->hasMany(ObjectiveTemplate::class, 'category_id');
    }
}
