<?php

namespace App\Models\MBO;

use App\Contracts\MBO\HasObjectives;
use App\Enums\MBO\CampaignStage;
use App\Events\MBO\Campaigns\UserCampaignAssigned;
use App\Events\MBO\Campaigns\UserCampaignUnassigned;
use App\Events\MBO\Campaigns\UserCampaignUpdated;
use App\Models\BaseModel;
use App\Models\Core\User;
use App\Traits\Guards\MBO\CanUserCampaign;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property string $id
 * @property string $campaign_id
 * @property string $user_id
 * @property mixed $stage User current campaign stage
 * @property bool $manual User will not be automatically moved between stages.
 * @property bool $active Is visible to users.
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\MBO\Campaign $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\Objective> $objectives
 * @property-read int|null $objectives_count
 * @property-read \App\Models\Core\User $user
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign active()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign average(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign avg(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign avgFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign checkAccess()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign count(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign countFromCache(string $columns = '*')
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign createMany(array $records)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign deleteQuietly()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign drafted()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign firstFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign flushCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign flushQueryCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign forceSave(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign getCacheKey($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign getFromCache($columns = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign inactive()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign insert(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign insertGetId(array $values, $sequence = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign insertOrIgnore(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign max(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign maxFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign min(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign minFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign newModelQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign newQuery()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign ongoing()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\UserCampaign onlyTrashed()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign orderForUser()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign paginateFromCache(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign prunableSoftDeletes()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign published()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign query()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign remember(int $minutes)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign restore()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign save(array $attributes = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign saveMany($models)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign sum(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign sumFromCache(string $column)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign truncate()
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign updateOrInsert(array $attributes, $values = [])
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign updateQuietly(array $values)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign whereActive($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign whereCampaignId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign whereCreatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign whereDeletedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign whereId($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign whereManual($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign whereStage($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign whereUpdatedAt($value)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\UserCampaign withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|\App\Models\MBO\UserCampaign withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|\App\Models\MBO\UserCampaign withoutTrashed()
 * @mixin \Eloquent
 */
class UserCampaign extends BaseModel implements HasObjectives
{
    use CanUserCampaign;

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

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class)->withTrashed();
    }

    public function objectives(): HasManyThrough
    {
        return $this->hasManyThrough(Objective::class, Campaign::class, 'id', 'campaign_id', 'campaign_id', 'id')->whereAssigned($this->user);
    }

    public function assignObjectives(): void
    {
        $templates = $this->campaign->objective_templates();
        if ($templates) {
            foreach ($templates as $template) {
                // TODO assign objectives from template assigned to a Campaign.
            }
        }
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
        if (CampaignStage::TERMINATED !== $this->stage) {
            $this->stage = CampaignStage::TERMINATED;

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

    public function scopeOngoing(Builder $query)
    {
        $query->where(function (Builder $query) {
            $query->whereHas('campaign');
            $query->where('active', 1)
                ->whereNotIn('stage', array(CampaignStage::TERMINATED, CampaignStage::CANCELED, CampaignStage::COMPLETED));
        });
    }

    public function scopeOrderForUser(Builder $query)
    {
        $query->orderByRaw(
            'FIELD(stage, "' . CampaignStage::SELF_EVALUATION . '", "' . CampaignStage::REALIZATION . '", "' . CampaignStage::EVALUATION . '", "' . CampaignStage::DISPOSITION . '", "' . CampaignStage::DEFINITION . '", "' . CampaignStage::IN_PROGRESS . '", "' . CampaignStage::PENDING . '")'
        );
    }
}
