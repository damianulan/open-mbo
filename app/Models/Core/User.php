<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Lab404\Impersonate\Models\Impersonate;
use App\Traits\Impersonable;
use App\Traits\HasRolesAndPermissions;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Facades\Forms\RequestForms;
use App\Traits\UserMBO;
use App\Traits\UserBusiness;
use App\Traits\ActiveFields;
use App\Models\Core\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Traits\Vendors\ModelActivity;
use App\Casts\Enigma;

/**
 * 
 *
 * @property string $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int $active
 * @property int $core
 * @property int $force_password_change
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\UserCampaign> $campaigns
 * @property-read int|null $campaigns_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $coordinator_campaigns
 * @property-read int|null $coordinator_campaigns_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\Department> $departments_manager
 * @property-read int|null $departments_manager_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments
 * @property-read int|null $employments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments_active
 * @property-read int|null $employments_active_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\Team> $leader_teams
 * @property-read int|null $leader_teams_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\UserObjective> $objective_assignments
 * @property-read int|null $objective_assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Core\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read UserProfile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Core\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $subordinates
 * @property-read int|null $subordinates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $supervisors
 * @property-read int|null $supervisors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\Team> $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereForcePasswordChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @method static \Database\Factories\Core\UserFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use UUID, HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, SoftDeletes, RequestForms;
    use UserMBO, UserBusiness, ActiveFields, Impersonate, Impersonable, ModelActivity;

    protected $fillable = [
        'email',
        'active',
        'core',
        'force_password_change',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $activeRules = [
        'active' => 1,
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    protected static function booted() {
        static::created(function(User $user) {

        });
        static::deleting(function(User $user) {
            $user->profile->delete();
       });
    }

    public function generatePassword()
    {
        $this->password = Hash::make(Str::random(10));
        return $this;
    }

    public function name(): string
    {
        return $this->profile->firstname . ' ' . $this->profile->lastname;
    }

    public function firstname() : string
    {
        return $this->profile->firstname;
    }

    public function lastname(): string
    {
        return $this->profile->lastname;
    }

    public function toggleLock(): bool
    {
        if($this->active == 1){
            $this->active = 0;
        } else {
            $this->active = 1;
        }
        if($this->update()){
            return true;
        }

        return false;
    }

    public function blocked(): bool
    {
        return $this->active ? false:true;
    }

    public function canBeDeleted(): bool
    {
        return $this->core==0||isRoot() ? true:false;
    }

    public function canBeSuspended(): bool
    {
        return $this->core==0||isRoot() ? true:false;
    }

    public function getAvatar(): ?string
    {
        if($this->profile->avatar){
            return asset($this->profile->avatar);
        }
        if($this->profile->gender->name === 'MALE'){
            return asset('images/portrait/avatar-male.png');
        } elseif($this->profile->gender->name === 'FEMALE'){
            return asset('images/portrait/avatar-female.png');
        }
        return null;
    }

    public function canBeImpersonated(): bool
    {
        return !$this->hasAnyRole('root', 'support')||isRoot();
    }

    public function canImpersonate(): bool
    {
        return $this->hasPermissionTo('impersonate');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

}
