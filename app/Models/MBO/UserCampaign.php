<?php

namespace App\Models\MBO;

use App\Contracts\MBO\AssignsPoints;
use App\Contracts\MBO\HasObjectives;
use App\Enums\MBO\CampaignStage;
use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Events\MBO\Campaigns\UserCampaignUnassigned;
use App\Events\MBO\Campaigns\UserCampaignUpdated;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Traits\Guards\MBO\CanUserCampaign;
use App\Traits\HasCharts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Lucent\Support\Traits\HasUniqueUuid;

/**
 * @property string $id
 * @property string $campaign_id
 * @property string $user_id
 * @property mixed $stage User current campaign stage
 * @property bool $manual User will not be automatically moved between stages.
 * @property bool $active Is visible to users.
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Campaign $campaign
 * @property-read mixed $points
 * @property-read mixed $trans
 * @property-read User $user
 * @property-read Collection<int, UserObjective> $user_objectives
 * @property-read int|null $user_objectives_count
 *
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign newQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign ongoing()
 * @method static Builder<static>|UserCampaign onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign orderForUser()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign whereActive($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign whereCampaignId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign whereManual($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign whereStage($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign whereUserId($value)
 * @method static Builder<static>|UserCampaign withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign withoutCache()
 * @method static Builder<static>|UserCampaign withoutTrashed()
 *
 * @mixin \Eloquent
 */
class UserCampaign extends BaseModel implements AssignsPoints, HasObjectives
{
    use CanUserCampaign;
    use HasCharts;
    use HasUniqueUuid;

    public $logEntities = array('user_id' => User::class, 'campaign_id' => Campaign::class);

    public $timestamps = true;

    protected $fillable = array(
        'campaign_id',
        'user_id',
        'stage',
        'manual',
        'active',
    );

    protected $casts = array(
        'active' => 'boolean',
        'manual' => 'boolean',
        'stage' => CampaignStage::class,
    );

    protected $dispatchesEvents = array(
        'created' => UserCampaignAssigned::class,
        'updated' => UserCampaignUpdated::class,
        'deleted' => UserCampaignUnassigned::class,
    );

    protected static function booted(): void
    {
        static::addGlobalScope('required_relations', function (Builder $builder): void {
            $builder->with(['user', 'campaign']);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function objectives(): HasManyThrough
    {
        return $this->hasManyThrough(Objective::class, Campaign::class, 'id', 'campaign_id', 'campaign_id', 'id')->whereAssigned($this->user);
    }

    public function user_objectives(): HasManyThrough
    {
        return $this->hasManyThrough(UserObjective::class, Objective::class, 'campaign_id', 'objective_id', 'campaign_id', 'id')->where('user_objectives.user_id', $this->user_id);
    }

    public function points(): Attribute
    {
        return Attribute::make(
            get: function (): void {
                $collection = new Collection();
                $this->user_objectives->each(function (UserObjective $userObjective) use (&$collection): void {
                    if ($userObjective->points) {
                        $collection->push($userObjective->points);
                    }
                });
            }
        );
    }

    public function calculatePoints(): float
    {
        $points = 0;

        $award = $this->objective->award ?? 0;
        if ($award > 0) {
            $points = round($award * ($this->evaluation / 100), 2);
        }

        return $points;
    }

    public function stageDescription(): string
    {
        return __('forms.campaigns.stages.' . $this->stage->value());
    }

    public function stageIcon(): string
    {
        $status = CampaignStage::stageIcon($this->stage->value());

        return $status;
    }

    public function terminate(): bool
    {
        if (CampaignStage::TERMINATED !== $this->stage->value()) {
            $this->stage = CampaignStage::tryFrom(CampaignStage::TERMINATED);

            return $this->update();
        }

        return false;
    }

    public function resume(): bool
    {
        $this->stage = CampaignStage::tryFrom(CampaignStage::IN_PROGRESS);

        return $this->update();
    }

    public function cancel(): bool
    {
        if (CampaignStage::CANCELED !== $this->stage->value()) {
            $this->stage = CampaignStage::tryFrom(CampaignStage::CANCELED);

            return $this->update();
        }

        return false;
    }

    public function nextStage(): bool
    {
        $stages = CampaignStage::sequences();
        $current = $stages[$this->stage];
        $next_count = $current + 1;
        if ($next_count >= count($stages)) {
            $next_count = count($stages) - 1;
        }

        $next = CampaignStage::getBySequence($next_count);
        $this->stage = $next;

        return $this->update();
    }

    public function previousStage(): bool
    {
        $stages = CampaignStage::sequences();
        $current = $stages[$this->stage];
        $prev_count = $current - 1;
        if ($prev_count <= 0) {
            $prev_count = 0;
        }

        $prev = CampaignStage::getBySequence($prev_count);
        $this->stage = $prev;

        return $this->update();
    }

    public function toggleManual(): bool
    {
        $this->manual = $this->manual ? 0 : 1;
        $this->stage = $this->campaign->setUserStage();

        return $this->update();
    }

    public function isManual(): bool
    {
        return $this->manual || $this->campaign?->manual;
    }

    /**
     * Sets users' objectives statuses based on campaign stage changes.
     */
    public function mapObjectiveStatus(): void
    {
        $objectives = $this->objectives();
        if ($objectives->count()) {
            foreach ($objectives as $objective) {
                $assignments = $objective->user_objectives()->whereUserId($this->user_id)->get();

                if ($assignments->count()) {
                    foreach ($assignments as $assignment) {
                        $assignment->setStatus()->update();
                    }
                }
            }
        }
    }

    public function scopeOngoing(Builder $query): void
    {
        $query->where(function (Builder $query): void {
            $query->whereHas('campaign');
            $query->where('active', 1)
                ->whereNotIn('stage', array(CampaignStage::TERMINATED, CampaignStage::CANCELED, CampaignStage::COMPLETED));
        });
    }

    public function scopeOrderForUser(Builder $query): void
    {
        $query->orderByRaw(
            'FIELD(stage, "' . CampaignStage::SELF_EVALUATION . '", "' . CampaignStage::REALIZATION . '", "' . CampaignStage::EVALUATION . '", "' . CampaignStage::DISPOSITION . '", "' . CampaignStage::DEFINITION . '", "' . CampaignStage::IN_PROGRESS . '", "' . CampaignStage::PENDING . '")'
        );
    }
}
