<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use FormForge\Casts\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\MBO\ObjectiveTemplate;
use App\Models\MBO\Campaign;
use App\Models\Core\User;
use App\Casts\Carbon\CarbonDatetime;
use App\Models\MBO\UserObjective;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use App\Enums\Core\SystemRolesLib;
use App\Models\Scopes\MBO\ObjectiveScope;
use Lucent\Support\Traits\Dispatcher;

/**
 *
 *
 * @property string $id
 * @property string|null $template_id
 * @property string|null $parent_id
 * @property string|null $campaign_id
 * @property string $name
 * @property mixed|null $description
 * @property mixed|null $deadline
 * @property string $weight
 * @property string|null $award
 * @property string|null $expected
 * @property mixed $draft
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Campaign|null $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Objective> $children
 * @property-read int|null $children_count
 * @property-read Objective|null $parent
 * @property-read ObjectiveTemplate|null $template
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserObjective> $user_assignments
 * @property-read int|null $user_assignments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereAward($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereExpected($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective withoutTrashed()
 * @mixin \Eloquent
 */
class Objective extends BaseModel
{
    use Dispatcher;

    protected $fillable = [
        'template_id',
        'campaign_id',
        'name',
        'description',
        'deadline',
        'weight',
        'draft',
        'award',
        'expected',
    ];

    protected $casts = [
        'draft' => 'boolean',
        'deadline' => CarbonDatetime::class,
        'description' => TrixFieldCast::class,
    ];


    protected $accessScope = ObjectiveScope::class;

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            if ($model->campaign_id) {
                $ucs = $model->campaign->user_campaigns;
                if ($ucs) {
                    foreach ($ucs as $uc) {
                        UserObjective::assign($uc->user_id, $model->id);
                    }
                }
            }
        });
    }

    public function isOverdued(): bool
    {
        if ($this->deadline) {
            $deadline = \Carbon\Carbon::parse($this->deadline);
            if ($deadline->isPast()) {
                return true;
            }
        }
        return false;
    }

    public function template()
    {
        return $this->belongsTo(ObjectiveTemplate::class, 'template_id');
    }

    public function category()
    {
        return $this->template?->category();
    }

    public function coordinators()
    {
        return $this->template?->coordinators();
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function type()
    {
        return $this->template()->type;
    }

    public function user_assignments()
    {
        return $this->hasMany(UserObjective::class);
    }

    public function canBeDeleted(): bool
    {
        return $this->user_assignments()->count() ? false : true;
    }

    public function scopeWhereAssigned(Builder $query, User $user): void
    {
        $query->select('objectives.*')
            ->join('user_objectives', function (JoinClause $join) use ($user) {
                $join->on('objectives.id', '=', 'user_objectives.objective_id')
                    ->where('user_objectives.user_id', $user->id);
            })
            ->published();
    }

    public static function creatingObjective(Objective $model): self
    {
        if ($model->campaign_id && empty($model->deadline)) {
            $campaign = Campaign::find($model->campaign_id);
            if ($campaign) {
                $model->deadline = $campaign->realization_to;
            }
        }

        return $model;
    }
}
