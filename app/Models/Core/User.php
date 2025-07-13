<?php

namespace App\Models\Core;

use App\Traits\UserBusiness;
use App\Traits\UserMBO;
use App\Traits\Vendors\Impersonable;
use App\Traits\Vendors\ModelActivity;
use FormForge\Traits\RequestForms;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use Lucent\Support\Str\Alphabet;
use Lucent\Support\Traits\UUID;
use Lucent\Support\Traits\VirginModel;
use Sentinel\Traits\HasRolesAndPermissions;

/**
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
 *
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
 *
 * @property-read UserPreference|null $preferences
 * @property-read mixed $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User drafted()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User inactive()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User published()
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasLocalePreference
{
    use HasApiTokens, HasFactory, HasRolesAndPermissions, Notifiable, RequestForms, SoftDeletes, UUID;
    use Impersonable, Impersonate, ModelActivity, UserBusiness, UserMBO, VirginModel;

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

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::created(function (User $user) {
            if (empty($user->preferences)) {
                $user->preferences()->create();
            }
        });
        static::deleting(function (User $user) {
            $user->profile->delete();
            $user->preferences->delete();
        });
    }

    public static function findByEmail(string $email): ?User
    {
        return self::where('email', $email)->first();
    }

    public function generatePassword()
    {
        $this->password = Hash::make(Str::random(10));

        return $this;
    }

    protected function name(): Attribute
    {
        $value = $this->profile?->firstname.' '.$this->profile?->lastname;

        return Attribute::make(
            get: fn () => ucfirst($value),
        );
    }

    public function nameView(): string
    {
        $link = '<span>'.$this->name().'</span>';
        if (Auth::user()->can('view', $this)) {
            $link = '<a href="'.route('users.show', $this->id).'" class="text-primary">'.$this->name().'</a>';
        }

        return $link;
    }

    public function nameDetails()
    {
        $view = view('components.datatables.username', ['data' => $this]);
        if (Auth::user()->can('view', $this)) {
            $view = view('components.datatables.username_link', ['data' => $this]);
        }

        return $view;
    }

    public function firstname(): string
    {
        return $this->profile?->firstname;
    }

    public function lastname(): string
    {
        return $this->profile?->lastname;
    }

    public function toggleLock(): bool
    {
        if ($this->active == 1) {
            $this->active = 0;
        } else {
            $this->active = 1;
        }
        if ($this->update()) {
            return true;
        }

        return false;
    }

    public function blocked(): bool
    {
        return $this->active ? false : true;
    }

    public function canBeDeleted(): bool
    {
        return $this->core == 0 || isRoot() ? true : false;
    }

    public function canBeSuspended(): bool
    {
        return $this->core == 0 || isRoot() ? true : false;
    }

    public function getAvatar(): ?string
    {
        if ($this->profile->avatar) {
            return asset($this->profile->avatar);
        }

        return null;
    }

    public function getInitials(): string
    {
        return strtoupper(substr($this->firstname(), 0, 1).substr($this->lastname(), 0, 1));
    }

    public function getAvatarView(int $height = 70, int $width = 70): string
    {
        if ($height !== $width) {
            $width = $height;
        }
        if ($this->profile->avatar) {
            return '<img class="profile-img" src="'.asset($this->profile->avatar).'" height="'.$height.'px" width="'.$width.'px">';
        }

        $fontSize = $height / 2.8;
        $initials = $this->getInitials();
        $letterNum = Alphabet::getAlphabetPosition($initials);

        $color = '#111';
        if ($letterNum < 4) {
            $color = 'orange';
        } elseif ($letterNum < 8) {
            $color = 'green';
        } elseif ($letterNum < 16) {
            $color = 'cyan';
        } elseif ($letterNum < 20) {
            $color = 'brown';
        } else {
            $color = 'red';
        }

        return '<div class="profile-img" style="background-color: var(--bs-'.$color.'); font-size: '.$fontSize.'px; min-height: '.$height.'px; min-width: '.$width.'px;"><div>'.$initials.'</div></div>';
    }

    public function canBeImpersonated(): bool
    {
        return ! $this->hasAnyRoles(['root', 'support']) || isRoot(true);
    }

    public function canImpersonate(): bool
    {
        return $this->hasPermissionTo('impersonate');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function preferences()
    {
        return $this->hasOne(UserPreference::class);
    }

    public function preferredLocale()
    {
        $locale = $this->preferences->lang ?? 'auto';
        if ($locale === 'auto') {
            $locale = app()->getLocale();
        }

        return $locale;
    }
}
