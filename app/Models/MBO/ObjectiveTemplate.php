<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\Scopes\MBO\ObjectiveTemplateScope;
use FormForge\Casts\TrixFieldCast;

/**
 * @property string $id
 * @property string|null $category_id
 * @property string $name
 * @property mixed|null $description
 * @property ObjectiveType $type
 * @property string|null $award
 * @property mixed $draft
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read ObjectiveTemplateCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Objective> $objectives
 * @property-read int|null $objectives_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereAward($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate withoutTrashed()
 * @method static \Database\Factories\MBO\ObjectiveTemplateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate checkAccess()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate drafted()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplate published()
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
        'draft' => 'boolean',
        'description' => TrixFieldCast::class,
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

        return $objective->save();
    }
}
