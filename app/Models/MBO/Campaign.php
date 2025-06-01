<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use FormForge\Casts\TrixFieldCast;
use Illuminate\Support\Collection;
use App\Models\MBO\Objective;
use App\Models\MBO\UserCampaign;
use Carbon\Carbon;
use App\Models\Core\User;
use App\Enums\MBO\CampaignStage;
use App\Models\Scopes\MBO\CampaignScope;
use Illuminate\Database\Eloquent\Builder;
use App\Events\MBO\Campaigns\CampaignUpdated;
use App\Events\MBO\Campaigns\CampaignCreated;
use Lucent\Support\Traits\Dispatcher;
use Laravel\Scout\Searchable;

/**
 *
 *
 * @property string $id
 * @property string $name
 * @property string $period
 * @property mixed|null $description
 * @property mixed $definition_from
 * @property mixed $definition_to
 * @property mixed $disposition_from
 * @property mixed $disposition_to
 * @property mixed $realization_from
 * @property mixed $realization_to
 * @property mixed $evaluation_from
 * @property mixed $evaluation_to
 * @property mixed $self_evaluation_from
 * @property mixed $self_evaluation_to
 * @property mixed $draft
 * @property mixed $manual
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $coordinators
 * @property-read int|null $coordinators_count
 * @property-read User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Objective> $objectives
 * @property-read int|null $objectives_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserCampaign> $user_campaigns
 * @property-read int|null $user_campaigns_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDefinitionFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDefinitionTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDispositionFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDispositionTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereEvaluationFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereEvaluationTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereRealizationFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereRealizationTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereSelfEvaluationFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereSelfEvaluationTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign withoutTrashed()
 * @property string $stage
 * @mixin \Eloquent
 */
class Campaign extends BaseModel
{
    use Dispatcher, Searchable;

    public $stages;
    public $timestamps = true;
    protected $log_name = 'mbo';

    protected $fillable = [
        'name',
        'period',
        'description',

        'definition_from',
        'definition_to',
        'disposition_from',
        'disposition_to',
        'realization_from',
        'realization_to',
        'evaluation_from',
        'evaluation_to',
        'self_evaluation_from',
        'self_evaluation_to',
        'stage', // current overall CampaignStage

        'draft',
        'manual',
    ];

    protected $casts = [
        'draft' => 'boolean',
        'manual' => 'boolean',

        'description' => TrixFieldCast::class,
    ];

    protected $defaults = [
        'stage' => CampaignStage::PENDING,
    ];

    protected $accessScope = CampaignScope::class;

    public function user_campaigns()
    {
        return $this->hasMany(UserCampaign::class);
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class);
    }

    public function coordinators()
    {
        return $this->morphToMany(User::class, 'context', 'users_roles');
    }

    public function refreshCoordinators(?array $user_ids)
    {
        if (!$user_ids) {
            $user_ids = array();
        }

        $current = $this->coordinators->pluck('id')->toArray();
        $toDelete = array_filter($current, function ($value) use ($user_ids) {
            return !in_array($value, $user_ids);
        });
        $toAdd = array_filter($user_ids, function ($value) use ($current) {
            return !in_array($value, $current);
        });

        foreach ($toDelete as $user_id) {
            $user = User::find($user_id);
            if ($user->exists()) {
                $user->revokeRoleSlug('campaign_coordinator', $this);
            }
        }
        foreach ($toAdd as $user_id) {
            $user = User::find($user_id);
            if ($user->exists()) {
                $user->assignRoleSlug('campaign_coordinator', $this);
            }
        }

        return true;
    }

    public function assignUser($user_id)
    {
        $exists = $this->user_campaigns()->where('user_id', $user_id)->exists();
        if (!$exists) {
            $this->user_campaigns()->create([
                'user_id' => $user_id,
                'stage' => $this->setUserStage($user_id),
                'manual' => $this->manual,
                'active' => $this->draft ? 0 : 1,
            ]);
        }
        return true;
    }

    public function unassignUser($user_id)
    {
        $record = $this->user_campaigns()->where('user_id', $user_id)->first();
        if ($record) {
            $record->delete();
        }
        return true;
    }

    public function setUserStage($user_id = null)
    {
        $params = ['manual' => 0, 'active' => 1];
        if ($user_id) {
            $params['user_id'] = $user_id;
        }

        $stage =  $this->getCurrentStages()->first();
        $enrols = $this->user_campaigns()->where($params)->get();
        if (!empty($enrols)) {
            foreach ($enrols as $enrol) {
                if ($stage !== $enrol->stage) {
                    $enrol->timestamps = false;
                    $enrol->stage = $stage;
                    $enrol->update();
                }
            }
        }
        return $stage;
    }

    public function setStageAuto()
    {
        $stage = CampaignStage::PENDING;
        $now = Carbon::now();

        foreach (CampaignStage::softValues() as $tmp) {
            $prop_start = $tmp . '_from';
            $prop_end = $tmp . '_to';
            $start = Carbon::parse($this->$prop_start);
            $end = Carbon::parse($this->$prop_end);

            if ($now->between($start, $end)) {
                $stage = CampaignStage::IN_PROGRESS;
                break;
            }
        }

        $this->stage = $stage;

        return $this;
    }

    public function getCurrentStages(): Collection
    {
        $stages = new Collection();
        $now = Carbon::now();

        if ($this->stage === CampaignStage::IN_PROGRESS) {
            $softStage = null;
            foreach (CampaignStage::softValues() as $tmp) {
                $prop_start = $tmp . '_from';
                $prop_end = $tmp . '_to';
                $start = Carbon::createFromFormat(config('app.from_datetime_format'), $this->$prop_start);
                $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->$prop_end);

                if ($now->between($start, $end)) {
                    $softStage = $tmp;
                    $stages->push($tmp);
                }
            }

            if (is_null($softStage)) {
                $stages->push($this->stage);
            }
        } else {
            $stages->push($this->stage);
        }

        return $stages;
    }

    public function open(): bool
    {
        $now = Carbon::now();
        $start = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateStart());
        $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateEnd());
        return $now->between($start, $end) && !$this->draft;
    }

    public function finished(): bool
    {
        if ($this->manual) {
            // TODO return true if all objectives are completed
            return false;
        }

        $now = Carbon::now();
        $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateEnd());
        return $now->greaterThan($end) && !$this->manual;
    }


    public function getProgress(): int
    {
        $now = Carbon::now();
        $start = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateStart());
        $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateEnd());
        if ($now >= $start) {
            $fullDiff = $start->diffInDays($end, false);
            $diff = abs($now->diffInDays($start));
            $progress = round(($diff / $fullDiff) * 100);
        } else {
            $progress = 0;
        }

        return $progress;
    }

    public function dateStart(): string
    {
        return $this->definition_from;
    }
    public function dateEnd(): string
    {
        return $this->self_evaluation_to;
    }

    public function inDates(): bool
    {
        $result = false;
        $start = $this->dateStart();
        $end = $this->dateEnd();
        $now = now();
        if ($start && $end) {
            if (!$start instanceof Carbon) {
                $start = Carbon::parse($start);
            }
            if (!$end instanceof Carbon) {
                $end = Carbon::parse($end);
            }

            if ($now->between($start, $end)) {
                $result = 1;
            } else {
                $result = 0;
            }
        }

        return $result;
    }

    public function dateStartView(): string
    {
        $start = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateStart());
        return $start->format(config('app.date_format'));
    }
    public function dateEndView(): string
    {
        $end = Carbon::createFromFormat(config('app.from_datetime_format'), $this->dateEnd());
        return $end->format(config('app.date_format'));
    }

    public function getSoftStages(): array
    {
        return CampaignStage::softValues();
    }

    public function getStageIcon(string $stage): ?string
    {
        return CampaignStage::stageIcon($stage);
    }

    public function getStageName(string $stage): ?string
    {
        return CampaignStage::getName($stage);
    }

    public function getStageInfo(string $stage): ?string
    {
        return CampaignStage::getInfo($stage);
    }

    public function isDraft(): bool
    {
        return $this->draft;
    }

    public function terminated(): bool
    {
        return $this->stage === CampaignStage::TERMINATED;
    }

    public function canceled(): bool
    {
        return $this->stage === CampaignStage::CANCELED;
    }

    public function completed(): bool
    {
        return $this->stage === CampaignStage::COMPLETED;
    }

    public function pending(): bool
    {
        return $this->stage === CampaignStage::PENDING;
    }

    public function isActive(): bool
    {
        return !$this->isDraft() && !$this->terminated() && !$this->canceled() && !$this->completed();
    }

    public function inProgress(): bool
    {
        return $this->stage === CampaignStage::IN_PROGRESS;
    }

    /**
     * LOCAL SCOPES
     */

    public function scopeWhereManual(Builder $query, int $manual): void
    {
        $query->where('manual', $manual);
    }

    public function scopeWhereActive(Builder $query): void
    {
        $query->where('draft', 0)
            ->where(function (Builder $q) {
                $q->whereIn('stage', [CampaignStage::PENDING, CampaignStage::IN_PROGRESS]);
            });
    }

    public function scopeWhereOngoing(Builder $query): void
    {
        $query->where('draft', 0)
            ->where(function (Builder $q) {
                $q->where('stage', CampaignStage::IN_PROGRESS)
                    ->orWhereDate('self_evaluation_to', '>', Carbon::now());
            });
    }

    public function scopeWhereCompleted(Builder $query): void
    {
        $query->where('draft', 0)
            ->whereNotIn('stage', [CampaignStage::TERMINATED, CampaignStage::CANCELED])
            ->where(function (Builder $q) {
                $q->where('stage', CampaignStage::COMPLETED)
                    ->orWhereDate('self_evaluation_to', '<', Carbon::now());
            });
    }

    public function scopeOrderByStatus(Builder $query): void
    {
        $in_progess = CampaignStage::IN_PROGRESS;
        $pending = CampaignStage::PENDING;
        $completed = CampaignStage::COMPLETED;
        $terminated = CampaignStage::TERMINATED;
        $canceled = CampaignStage::CANCELED;

        $query->orderByRaw("FIELD(stage, '$in_progess', '$pending', '$completed', '$terminated', '$canceled')");
    }

    public static function retrievedCampaign(Campaign $model)
    {
        $model->setUserStage();
    }

    public static function creatingCampaign(Campaign $model)
    {
        return self::updatingCampaign($model);
    }

    public static function createdCampaign(Campaign $model)
    {
        CampaignCreated::dispatch($model);
    }

    public static function updatingCampaign(Campaign $model)
    {
        if (!setting('mbo.campaigns_manual')) {
            $model->manual = 0;
        }

        if ($model->manual == 0) {
            $model->setStageAuto();
        }

        return $model;
    }

    public static function updatedCampaign(Campaign $model)
    {
        $ucs = $model->user_campaigns()->get();
        if ($ucs && $ucs->count()) {
            foreach ($ucs as $uc) {
                $uc->active = $model->draft ? 0 : 1;
                $uc->save();
            }
        }
        $objectives = $model->objectives()->get();
        if ($objectives && $objectives->count()) {
            $realization_from = $model->realization_from ? Carbon::parse($model->realization_from) : null;
            $realization_to = $model->realization_to ? Carbon::parse($model->realization_to) : null;

            foreach ($objectives as $objective) {
                $objective->draft = $model->draft;
                $deadline = $objective->deadline ? Carbon::parse($objective->deadline) : null;
                if ($deadline) {
                    if ($deadline->isBefore($realization_from)) {
                        $objective->deadline = $realization_from;
                    }
                    if ($deadline->isAfter($realization_to)) {
                        $objective->deadline = $realization_to;
                    }
                }
                $objective->save();
            }
        }
        CampaignUpdated::dispatch($model);
    }
}
