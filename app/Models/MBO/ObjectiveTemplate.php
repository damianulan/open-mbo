<?php

namespace App\Models\MBO;

use App\Casts\FormattedText;
use App\Contracts\MBO\HasObjectives;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\Scopes\MBO\ObjectiveTemplateScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string|null $category_id
 * @property string $name
 * @property mixed|null $description
 * @property string|null $award Max points to be awarded for objective completion
 * @property bool $draft
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read ObjectiveTemplateCategory|null $category
 * @property-read Collection<int, Objective> $objectives
 * @property-read int|null $objectives_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate drafted()
 * @method static \Database\Factories\MBO\ObjectiveTemplateFactory factory($count = null, $state = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\ObjectiveTemplate onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate whereAward($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate whereCategoryId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate whereDraft($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\ObjectiveTemplate withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\ObjectiveTemplate withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\ObjectiveTemplate withoutTrashed()
 *
 * @mixin \Eloquent
 */
#[ScopedBy(ObjectiveTemplateScope::class)]
class ObjectiveTemplate extends BaseModel implements HasObjectives
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

    protected $cascadeDelete = [
        'objectives',
    ];

    public function category()
    {
        return $this->belongsTo(ObjectiveTemplateCategory::class, 'category_id');
    }

    public function objectives(): HasMany
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
                $result += $objective->user_objectives()->count();
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
        $objective = new Objective();
        $objective->template_id = $this->id;
        $objective->user_id = $user->id;
        $objective->name = $this->name;
        $objective->description = $this->description;
        $objective->draft = 1;
        $objective->award = $this->award;

        return $objective->save() ? true : false;
    }

    protected static function boot(): void
    {
        parent::boot();
    }
}
