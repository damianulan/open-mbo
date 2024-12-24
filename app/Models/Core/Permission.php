<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

/**
 * 
 *
 * @property string $id
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Core\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereUpdatedAt($value)
 * @property int $assignable
 * @mixin \Eloquent
 */
class Permission extends Model
{
    use UUID, HasFactory;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    public static $coreRoleSeeds = [
        'telescope-view' => ['root', 'support'],
        'maintenance' => ['root', 'support'],
    ];
    public static $roleSeeds = [
        // users
        'users-impersonate' => ['admins'],

        // mbo
        'mbo-campaign-create' => ['admins', 'admin_mbo'],
        'mbo-campaign-view' => ['admins', 'admin_mbo', 'campaign_coordinator'],
        'mbo-campaign-update' => ['admins', 'admin_mbo', 'campaign_coordinator'],
        'mbo-campaign-delete' => ['admins', 'admin_mbo'],
        'mbo-campaign-manage' => ['admins', 'admin_mbo', 'campaign_coordinator'], // dodawanie/usuwanie użytkowników i celów do kampanii.

        'mbo-objective-create' => ['admins', 'admin_mbo', 'objective_coordinator'],
        'mbo-objective-view' => ['admins', 'admin_mbo', 'objective_coordinator'],
        'mbo-objective-update' => ['admins', 'admin_mbo', 'objective_coordinator'],
        'mbo-objective-delete' => ['admins', 'admin_mbo'],
        'mbo-objective-milestones' => ['admins', 'admin_mbo', 'objective_coordinator', 'supervisor'],
        'mbo-objective-realization' => ['admins', 'admin_mbo', 'objective_coordinator', 'supervisor'],
    ];

    public $timestamps = true;

    protected $fillable = [
        'slug',
        'assignable',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'roles_permissions');
    }

    public static function getSelectList(): array
    {
        $output = array();
        $permissions = self::where('assignable', 1)->get();
        if(!$permissions->isEmpty()){
            foreach ($permissions as $permission){
                $name = __('gates.permissions.'.$permission->slug);
                $output[$permission->id] = $name;
            }
        }
        return $output;
    }
}
