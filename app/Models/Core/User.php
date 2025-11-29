<?php

namespace App\Models\Core;

use App\Commentable\Models\Comment;
use App\Commentable\Support\Commentable;
use App\Commentable\Support\Commentator;
use App\Contracts\Core\HasShowRoute;
use App\Models\Business\Team;
use App\Models\Business\UserEmployment;
use App\Models\MBO\BonusScheme;
use App\Models\MBO\Campaign;
use App\Models\MBO\Objective;
use App\Models\MBO\UserBonusScheme;
use App\Models\MBO\UserCampaign;
use App\Models\MBO\UserObjective;
use App\Models\MBO\UserPoints;
use App\Models\Vendor\ActivityModel;
use App\Support\Notifications\Models\MailNotification;
use App\Support\Notifications\Models\SystemNotification;
use App\Support\Notifications\Traits\Notifiable;
use App\Traits\Favouritable;
use App\Traits\IsTranslated;
use App\Traits\UserBusiness;
use App\Traits\UserMBO;
use App\Traits\Vendors\Impersonable;
use App\Traits\Vendors\ModelActivity;
use FormForge\Traits\RequestForms;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Scout\Searchable;
use Lucent\Support\Str\Alphabet;
use Lucent\Support\Traits\CascadeDeletes;
use Lucent\Support\Traits\UUID;
use Lucent\Support\Traits\VirginModel;
use Sentinel\Models\Permission;
use Sentinel\Traits\HasRolesAndPermissions;
use Spatie\Activitylog\Models\Activity;

/**
 * @property string $id
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property int $active
 * @property int $core Core user - comes as default with the application - cannot be deleted
 * @property int $force_password_change Force user to change password after first login
 * @property string|null $remember_token
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ActivityModel> $activity
 * @property-read int|null $activity_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserPoints> $awards
 * @property-read int|null $awards_count
 * @property-read BonusScheme|null $bonus_scheme
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserCampaign> $campaigns
 * @property-read int|null $campaigns_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserCampaign> $campaigns_ongoing
 * @property-read int|null $campaigns_ongoing_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MailNotification> $email_notifications
 * @property-read int|null $email_notifications_count
 * @property-read UserEmployment|null $employment
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserEmployment> $employments
 * @property-read int|null $employments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserEmployment> $employments_active
 * @property-read int|null $employments_active_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Campaign> $favourite_campaigns
 * @property-read int|null $favourite_campaigns_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $favourite_to
 * @property-read int|null $favourite_to_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $favourite_users
 * @property-read int|null $favourite_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Team> $leader_teams
 * @property-read int|null $leader_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $my_comments
 * @property-read int|null $my_comments_count
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Objective> $objectives
 * @property-read int|null $objectives_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read mixed $points
 * @property-read UserPreference|null $preferences
 * @property-read UserProfile|null $profile
 * @property-read Collection $sessions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $subordinates
 * @property-read int|null $subordinates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $supervisors
 * @property-read int|null $supervisors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, SystemNotification> $system_notifications
 * @property-read int|null $system_notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Team> $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read mixed $trans
 * @property-read UserBonusScheme|null $user_bonus_scheme
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserObjective> $user_objectives
 * @property-read int|null $user_objectives_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserObjective> $user_objectives_active
 * @property-read int|null $user_objectives_active_count
 * @method static Builder<static>|User active()
 * @method static Builder<static>|User drafted()
 * @method static \Database\Factories\Core\UserFactory factory($count = null, $state = [])
 * @method static Builder<static>|User inactive()
 * @method static Builder<static>|User newModelQuery()
 * @method static Builder<static>|User newQuery()
 * @method static Builder<static>|User onlyTrashed()
 * @method static Builder<static>|User published()
 * @method static Builder<static>|User query()
 * @method static Builder<static>|User whereActive($value)
 * @method static Builder<static>|User whereCore($value)
 * @method static Builder<static>|User whereCreatedAt($value)
 * @method static Builder<static>|User whereDeletedAt($value)
 * @method static Builder<static>|User whereEmail($value)
 * @method static Builder<static>|User whereEmailVerifiedAt($value)
 * @method static Builder<static>|User whereFirstname(string $value)
 * @method static Builder<static>|User whereForcePasswordChange($value)
 * @method static Builder<static>|User whereId($value)
 * @method static Builder<static>|User whereLastname(string $value)
 * @method static Builder<static>|User wherePassword($value)
 * @method static Builder<static>|User whereRememberToken($value)
 * @method static Builder<static>|User whereUpdatedAt($value)
 * @method static Builder<static>|User withPermission(...$slugs)
 * @method static Builder<static>|User withRole(...$slugs)
 * @method static Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasLocalePreference, HasShowRoute
{
    use CascadeDeletes;
    use Commentable;
    use Commentator;
    use Favouritable;
    use HasApiTokens;
    use HasFactory;
    use HasRolesAndPermissions;
    use Impersonable;
    use Impersonate;
    use IsTranslated;
    use ModelActivity;
    use Notifiable;
    use RequestForms;
    use Searchable;
    use SoftDeletes;
    use UUID;
    use UserBusiness;
    use UserMBO;
    use VirginModel;

    protected $fillable = array(
        'email',
        'active',
        'core',
        'force_password_change',
    );

    protected $hidden = array(
        'password',
        'remember_token',
    );

    protected $casts = array(
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
    );

    protected $cascadeDeletes = array(
        'profile',
        'preferences',
    );

    public static function findByEmail(string $email): ?User
    {
        return self::where('email', $email)->first();
    }

    public function generatePassword()
    {
        $this->password = Hash::make(Str::random(10));

        return $this;
    }

    public function nameView(): string
    {
        $link = '<span>' . $this->name . '</span>';
        if (Auth::user()->can('view', $this)) {
            $link = '<a href="' . route('users.show', $this->id) . '" class="text-primary">' . $this->name . '</a>';
        }

        return $link;
    }

    public function nameDetails()
    {
        $view = view('components.datatables.username', array('data' => $this));
        if (Auth::user()->can('view', $this)) {
            $view = view('components.datatables.username_link', array('data' => $this));
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
        if (1 === $this->active) {
            $this->active = 0;
        } else {
            $this->active = 1;
        }

        return (bool) ($this->update());
    }

    public function blocked(): bool
    {
        return $this->active ? false : true;
    }

    public function canBeDeleted(): bool
    {
        return 0 === $this->core || isRoot() ? true : false;
    }

    public function canBeSuspended(): bool
    {
        return 0 === $this->core || isRoot() ? true : false;
    }

    public function getAvatar(): ?string
    {
        if ($this->profile->avatar) {
            return asset($this->profile->avatar);
        }

        return null;
    }

    public function itsMe(): bool
    {
        return Auth::check() && $this->id === Auth::user()->id;
    }

    public function lastActivityTime(): int
    {
        $activity = 0;
        if ($this->sessions->isNotEmpty()) {
            $lastSession = $this->sessions->first();
            if ($lastSession) {
                $activity = (int) $lastSession->last_activity;
            }
        }

        return $activity;
    }

    public function isLoggedIn(): bool
    {
        return ($this->lastActivityTime() + ((int) config('session.lifetime') * 60)) > time();
    }

    public function getInitials(): string
    {
        return mb_strtoupper(mb_substr($this->firstname(), 0, 1) . mb_substr($this->lastname(), 0, 1));
    }

    public function getAvatarView($size = 'lg'): string
    {
        $initials = $this->getInitials();
        $letterNum = Alphabet::getAlphabetPosition($initials);

        $color = 'primary';
        if ( ! $this->isAdmin()) {
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
        }
        $indicator = '';
        if ( ! $this->itsMe() && $this->isLoggedIn()) {
            $indicator = '<div class="profile-indicator"></div>';
        }

        return '<div class="profile-img-' . $size . '" style="background-color: var(--bs-' . $color . ');"><div>' . $initials . '</div>' . $indicator . '</div>';
    }

    public function canBeImpersonated(): bool
    {
        return ! $this->hasAnyRoles(array('root', 'support')) || isRoot(true);
    }

    public function canImpersonate(): bool
    {
        return $this->hasPermissionTo('impersonate');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function preferences(): HasOne
    {
        return $this->hasOne(UserPreference::class);
    }

    public function activity()
    {
        return $this->morphMany(ActivityModel::class, 'causer');
    }

    public function favourite_users()
    {
        return $this->morphedByMany(User::class, 'subject', 'favourities');
    }

    public function favourite_campaigns()
    {
        return $this->morphedByMany(Campaign::class, 'subject', 'favourities');
    }

    public function preferredLocale()
    {
        $locale = $this->preferences->lang ?? 'auto';
        if ('auto' === $locale) {
            $locale = app()->getLocale();
        }

        return $locale;
    }

    public function scopeWhereFirstname(Builder $query, string $value): void
    {
        $query->whereHas('profile', function (Builder $query) use ($value): void {
            $query->whereRaw('LOWER(`firstname`) LIKE ?', array(Str::lower($value)));
        });
    }

    public function scopeWhereLastname(Builder $query, string $value): void
    {
        $query->whereHas('profile', function (Builder $query) use ($value): void {
            $query->whereRaw('LOWER(`lastname`) LIKE ?', array(Str::lower($value)));
        });
    }

    public function routeShow(): string
    {
        return route('users.show', $this->id);
    }

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if ( ! isset($user->password) || empty($user->password)) {
                $user->generatePassword();
            }

            return $user;
        });

        static::created(function (User $user): void {
            if (empty($user->preferences)) {
                $user->preferences()->create();
            }
        });
        static::deleting(function (User $user): void {
            $user->profile->delete();
            $user->preferences->delete();
        });
    }

    protected function name(): Attribute
    {
        $value = $this->profile?->firstname . ' ' . $this->profile?->lastname;

        return Attribute::make(
            get: fn () => mb_ucfirst($value),
        );
    }

    protected function sessions(): Attribute
    {
        return Attribute::make(
            get: fn (): Collection => 'database' === config('session.driver') ? DB::table('sessions')->where('user_id', $this->id)->orderByDesc('last_activity')->get() : new Collection(),
        );
    }
}
