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

/**
 * @property string $id
 * @property string $campaign_id
 * @property string $user_id
 * @property string $stage User current campaign stage
 * @property bool $manual User will not be automatically moved between stages.
 * @property bool $active Is visible to users.
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Campaign $campaign
 * @property-read Collection<int, Objective> $objectives
 * @property-read int|null $objectives_count
 * @property-read User $user
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign onlyTrashed()
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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign withTrashed(bool $withTrashed = true)
 * @method static \YMigVal\LaravelModelCache\CacheableBuilder<static>|UserCampaign withoutCache()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign withoutTrashed()
 *
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
        return __('forms.campaigns.stages.' . $this->stage);
    }

    public function stageIcon(): string
    {
        $status = CampaignStage::stageIcon($this->stage);

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
        $this->stage = CampaignStage::IN_PROGRESS;

        return $this->update();
    }

    public function cancel(): bool
    {
        if (CampaignStage::CANCELED !== $this->stage) {
            $this->stage = CampaignStage::CANCELED;

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
}
