<?php

namespace App\Models\MBO;

use App\Casts\FormattedText;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\Scopes\MBO\ObjectiveTemplateCategoryScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Core\User> $coordinators
 * @property-read int|null $coordinators_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\ObjectiveTemplate> $objective_templates
 * @property-read int|null $objective_templates_count
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\ObjectiveTemplateCategory onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory whereIcon($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory whereShortname($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\ObjectiveTemplateCategory withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplateCategory withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\ObjectiveTemplateCategory withoutTrashed()
 * @mixin \Eloquent
 */
#[ScopedBy(ObjectiveTemplateCategoryScope::class)]
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

    public function refreshCoordinators(?array $user_ids): void
    {
        if ( ! $user_ids) {
            $user_ids = [];
        }

        $current = $this->coordinators->pluck('id')->toArray();
        $toDelete = array_filter($current, fn ($value) => ! in_array($value, $user_ids));
        $toAdd = array_filter($user_ids, fn ($value) => ! in_array($value, $current));

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

    protected static function boot(): void
    {
        parent::boot();
        static::deleted(function ($model): void {
            $model->objective_templates()->delete();
            $model->coordinators()->delete();
        });
    }
}
