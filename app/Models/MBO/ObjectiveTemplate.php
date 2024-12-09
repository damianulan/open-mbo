<?php

namespace App\Models\MBO;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Vendors\TrixFields;
use App\Facades\Forms\RequestForms;
use App\Facades\TrixField\TrixFieldCast;
use App\Casts\CheckboxCast;
use App\Models\Core\User;
use App\Models\MBO\Objective;
use App\Models\MBO\CampaignObjective;
use App\Models\MBO\ObjectiveTemplateCategory;
use App\Enums\MBO\ObjectiveType;

/**
 *
 *
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
 * @mixin \Eloquent
 */
class ObjectiveTemplate extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'type',
        'draft',
        'award',
    ];

    protected $casts = [
        'draft' => CheckboxCast::class,
        'description' => TrixFieldCast::class,
        'type' => ObjectiveType::class,
    ];

    public static function allActive()
    {
        return self::where('draft', 0)->get();
    }

    public function category()
    {
        return $this->belongsTo(ObjectiveTemplateCategory::class, 'category_id');
    }

    public function objectives()
    {
        return $this->hasMany(Objective::class, 'template_id');
    }

    public function usersCount(): int
    {
        $result = 0;
        if($this->objectives){
            foreach($this->objectives as $objective){
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
        return $this->category()->global ? true:false;
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
        return $objective->save();
    }
}
