<?php

namespace App\Models\MBO;

use App\Casts\FormattedText;
use App\Contracts\MBO\HasObjectives;
use App\Enums\MBO\CampaignStage;
use App\Events\MBO\Campaigns\CampaignCreated;
use App\Events\MBO\Campaigns\CampaignUpdated;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Models\Scopes\MBO\CampaignScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Lucent\Support\Traits\Dispatcher;

/**
 * @property string $id
 * @property string $name
 * @property string $period
 * @property mixed|null $description
 * @property string|null $definition_from
 * @property string|null $definition_to
 * @property string|null $disposition_from
 * @property string|null $disposition_to
 * @property string|null $realization_from
 * @property string|null $realization_to
 * @property string|null $evaluation_from
 * @property string|null $evaluation_to
 * @property string|null $self_evaluation_from
 * @property string|null $self_evaluation_to
 * @property mixed $stage Campaign current status whether in progress, pending, completed, terminated or canceled
 * @property bool $draft Visible to admins only and is not automatically published.
 * @property bool $manual Will not be automatically moved between stages.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read EloquentCollection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read EloquentCollection<int, User> $coordinators
 * @property-read int|null $coordinators_count
 * @property-read EloquentCollection<int, \App\Models\MBO\Objective> $objectives
 * @property-read int|null $objectives_count
 * @property-read mixed $timeend
 * @property-read mixed $timestart
 * @property-read EloquentCollection<int, \App\Models\MBO\UserCampaign> $user_campaigns
 * @property-read int|null $user_campaigns_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign newQuery()
 * @method static Builder<static>|Campaign onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign orderByStatus()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereActive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereCompleted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereDefinitionFrom($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereDefinitionTo($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereDescription($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereDispositionFrom($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereDispositionTo($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereDraft($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereEvaluationFrom($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereEvaluationTo($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereManual($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereName($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereOngoing()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign wherePeriod($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereRealizationFrom($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereRealizationTo($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereSelfEvaluationFrom($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereSelfEvaluationTo($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereStage($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign whereUpdatedAt($value)
 * @method static Builder<static>|Campaign withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|Campaign withoutCache()
 * @method static Builder<static>|Campaign withoutTrashed()
 *
 * @mixin \Eloquent
 */
#[ScopedBy(CampaignScope::class)]
class Campaign extends BaseModel implements HasObjectives
{
    use Dispatcher;

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
        'description' => FormattedText::class,
        'draft' => 'boolean',
        'manual' => 'boolean',
        'stage' => CampaignStage::class,
    ];

    protected $defaults = [
        'stage' => CampaignStage::PENDING,
    ];

    protected $dispatchesEvents = [
        'updated' => CampaignUpdated::class,
        'created' => CampaignCreated::class,
    ];

    public function user_campaigns(): HasMany
    {
        return $this->hasMany(UserCampaign::class);
    }

    public function objectives(): HasMany
    {
        return $this->hasMany(Objective::class);
    }

    public function coordinators(): MorphToMany
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
        if (! $exists) {
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
        $params = ['manual' => 0, 'active' => 1, 'campaign_id' => $this->id];
        if ($user_id) {
            $params['user_id'] = $user_id;
        }

        $stage = $this->getCurrentStages()->first();
        if (is_null($stage)) {
            $stage = CampaignStage::PENDING;
        }

        UserCampaign::where($params)->where('stage', '!=', $stage)->chunk(config('app.chunk_default'), function (EloquentCollection $collection) use ($stage) {
            foreach ($collection as $uc) {
                $uc->stage = $stage;
                $uc->update();
            }
        });

        return $stage;
    }

    public function setStageAuto()
    {
        $stage = CampaignStage::PENDING;
        $now = Carbon::now();

        if (! in_array($this->stage, [CampaignStage::TERMINATED, CampaignStage::CANCELED])) {
            foreach (CampaignStage::softValues() as $tmp) {
                $prop_start = $tmp.'_from';
                $prop_end = $tmp.'_to';
                $start = Carbon::parse($this->$prop_start);
                $end = Carbon::parse($this->$prop_end);

                if ($now->between($start, $end)) {
                    $stage = CampaignStage::IN_PROGRESS;
                    break;
                }
            }

            $end = $this->timeend;

            if ($end->isPast()) {
                $stage = CampaignStage::COMPLETED;
            }

            $this->stage = $stage;

        }

        return $this;
    }

    public function getCurrentStages(): Collection
    {
        $stages = new Collection;
        $now = Carbon::now();

        if ((string) $this->stage === CampaignStage::IN_PROGRESS) {
            $softStage = null;
            foreach (CampaignStage::softValues() as $tmp) {
                $prop_start = $tmp.'_from';
                $prop_end = $tmp.'_to';
                $start = Carbon::parse($this->$prop_start);
                $end = Carbon::parse($this->$prop_end);

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
        $start = Carbon::parse($this->dateStart());
        $end = Carbon::parse($this->dateEnd());

        return $now->between($start, $end) && ! $this->draft;
    }

    public function finished(): bool
    {
        if ($this->manual) {
            // TODO return true if all objectives are completed
            return false;
        }

        $now = Carbon::now();
        $end = Carbon::parse($this->dateEnd());

        return $now->greaterThan($end) && ! $this->manual;
    }

    public function getProgress(): int
    {
        $now = Carbon::now();
        $start = Carbon::parse($this->dateStart());
        $end = Carbon::parse($this->dateEnd());
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

    protected function timestart(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->definition_from),
        );
    }

    protected function timeend(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->self_evaluation_to),
        );
    }

    public function inDates(): bool
    {
        $result = false;
        $start = $this->dateStart();
        $end = $this->dateEnd();
        $now = now();
        if ($start && $end) {
            if (! $start instanceof Carbon) {
                $start = Carbon::parse($start);
            }
            if (! $end instanceof Carbon) {
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
        $start = Carbon::parse($this->dateStart());

        return $start->format(config('app.date_format'));
    }

    public function dateEndView(): string
    {
        $end = Carbon::parse($this->dateEnd());

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

    public function cancel(): bool
    {
        if ($this->stage !== CampaignStage::CANCELED) {
            $this->stage = CampaignStage::CANCELED;

            foreach ($this->user_campaigns as $userCampaign) {
                $userCampaign->cancel();
            }

            return $this->update();
        }

        return false;
    }

    public function terminate(): bool
    {
        if ($this->stage !== CampaignStage::TERMINATED) {
            $this->stage = CampaignStage::TERMINATED;

            foreach ($this->user_campaigns as $userCampaign) {
                $userCampaign->terminate();
            }

            return $this->update();
        }

        return false;
    }

    public function resume(): bool
    {
        if ($this->stage === CampaignStage::TERMINATED) {
            $this->stage = CampaignStage::IN_PROGRESS;

            foreach ($this->user_campaigns as $userCampaign) {
                $userCampaign->resume();
            }

            return $this->update();
        }

        return false;
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
        return ! $this->isDraft() && ! $this->terminated() && ! $this->canceled() && ! $this->completed();
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
        $orderBy = "FIELD(stage, '$in_progess', '$pending', '$completed', '$terminated', '$canceled')";
        $query->orderByRaw($orderBy);
    }

    public static function creatingCampaign(Campaign $model)
    {
        return self::updatingCampaign($model);
    }

    public static function updatingCampaign(Campaign $model)
    {
        if (! settings('mbo.campaigns_manual')) {
            $model->manual = 0;
        }

        return $model;
    }
}
