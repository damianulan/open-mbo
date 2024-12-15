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
use App\Models\MBO\ObjectiveTemplate;
use App\Models\Core\User;

/**
 *
 *
 * @property string $id
 * @property string $name
 * @property mixed|null $description
 * @property string|null $icon
 * @property mixed $global
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ObjectiveTemplate> $objective_templates
 * @property-read int|null $objective_templates_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory whereGlobal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ObjectiveTemplateCategory withoutTrashed()
 * @mixin \Eloquent
 */
class ObjectiveTemplateCategory extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'name',
        'shortname',
        'description',
        'icon',
        'global',
    ];

    protected $casts = [
        'description' => TrixFieldCast::class,
        'global' => CheckboxCast::class,
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

    public function coordinators()
    {
        return $this->morphToMany(User::class, 'context', 'users_roles');
    }

    public function refreshCoordinators(?array $user_ids)
    {
        if(!$user_ids){
            $user_ids = array();
        }

        $current = $this->coordinators->pluck('id')->toArray();
        $toDelete = array_filter($current, function ($value) use ($user_ids) {
            return !in_array($value, $user_ids);
        });
        $toAdd = array_filter($user_ids, function ($value) use ($current) {
            return !in_array($value, $current);
        });

        foreach($toDelete as $user_id){
            $user = User::find($user_id);
            if($user->exists()){
                $user->revokeRole('objective_coordinator', $this);
            }
        }
        foreach($toAdd as $user_id){
            $user = User::find($user_id);
            if($user->exists()){
                $user->assignRole('objective_coordinator', $this);
            }
        }
    }

    public function objective_templates()
    {
        return $this->hasMany(ObjectiveTemplate::class, 'category_id');
    }
}
