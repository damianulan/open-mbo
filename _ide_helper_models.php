<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Facades\DataTables{
/**
 * 
 *
 * @property int $id
 * @property string $user_id
 * @property string $table_id
 * @property array $columns
 * @property array $selected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereColumns($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereSelected($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SelectedColumns whereUserId($value)
 * @mixin \Eloquent
 */
	class SelectedColumns extends \Eloquent {}
}

namespace App\Facades\Fields{
/**
 * 
 *
 * @property string $id
 * @property string $fullname
 * @property string $slug
 * @property string $field_type
 * @property string $db_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereDbType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereFieldType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FieldModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class FieldModel extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel withoutTrashed()
 * @mixin \Eloquent
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models\Business{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $shortname
 * @property mixed|null $description
 * @property string|null $logo
 * @property \Illuminate\Support\Carbon|null $founded
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments
 * @property-read int|null $employments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Location> $locations
 * @property-read int|null $locations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereShortname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Company withoutTrashed()
 * @method static \Database\Factories\Business\CompanyFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
	class Company extends \Eloquent {}
}

namespace App\Models\Business{
/**
 * 
 *
 * @property string $id
 * @property string|null $parent_id
 * @property string $manager_id
 * @property string $name
 * @property mixed|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Department> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserEmployment> $employments
 * @property-read int|null $employments_count
 * @property-read User $manager
 * @property-read Department|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Department withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $managers
 * @property-read int|null $managers_count
 * @mixin \Eloquent
 * @property string $shortname
 */
	class Department extends \Eloquent {}
}

namespace App\Models\Business{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $city
 * @property string|null $postal_code
 * @property mixed|null $description
 * @property bool $active
 * @property string|null $founded
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Company> $companies
 * @property-read int|null $companies_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Location withoutTrashed()
 * @method static \Database\Factories\Business\LocationFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 * @property string|null $country
 */
	class Location extends \Eloquent {}
}

namespace App\Models\Business{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property mixed|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments
 * @property-read int|null $employments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Position withoutTrashed()
 * @mixin \Eloquent
 */
	class Position extends \Eloquent {}
}

namespace App\Models\Business{
/**
 * 
 *
 * @property string $id
 * @property string $leader_id
 * @property string $name
 * @property mixed|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read User $leader
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereLeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Team withoutTrashed()
 * @mixin \Eloquent
 */
	class Team extends \Eloquent {}
}

namespace App\Models\Business{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property mixed|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Business\UserEmployment> $employments
 * @property-read int|null $employments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfContract withoutTrashed()
 * @mixin \Eloquent
 * @property string $shortname
 */
	class TypeOfContract extends \Eloquent {}
}

namespace App\Models\Business{
/**
 * 
 *
 * @property string $id
 * @property string|null $foreign_id
 * @property string $user_id
 * @property string $company_id
 * @property string $contract_id
 * @property string $department_id
 * @property string $position_id
 * @property mixed $employment
 * @property mixed|null $release
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Company $company
 * @property-read TypeOfContract $contract
 * @property-read Department $department
 * @property-read Position $position
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereEmployment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereForeignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereRelease($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserEmployment withoutTrashed()
 * @mixin \Eloquent
 */
	class UserEmployment extends \Eloquent {}
}

namespace App\Models\Core{
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
	class Permission extends \Eloquent {}
}

namespace App\Models\Core{
/**
 * 
 *
 * @property string $id
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Core\Permission> $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 * @property bool $assignable
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Models\Core{
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
 * @property-read UserPreference|null $preferences
 * @mixin \Eloquent
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Translation\HasLocalePreference {}
}

namespace App\Models\Core{
/**
 * 
 *
 * @property int $id
 * @property string $user_id
 * @property string $lang
 * @property string $theme
 * @property bool $mail_notifications
 * @property bool $app_notifications
 * @property bool $extended_notifications
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPreference withoutTrashed()
 * @property bool $system_notifications
 * @mixin \Eloquent
 */
	class UserPreference extends \Eloquent {}
}

namespace App\Models\Core{
/**
 * 
 *
 * @property int $id
 * @property string $user_id
 * @property string $firstname
 * @property string $lastname
 * @property Gender $gender
 * @property string|null $birthday
 * @property string|null $phone
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProfile withoutTrashed()
 * @property string $lang
 * @method static \Database\Factories\Core\UserProfileFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
	class UserProfile extends \Eloquent {}
}

namespace App\Models\MBO{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property mixed|null $description
 * @property array $options
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MBO\UserBonusAssignment> $assignments
 * @property-read int|null $assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BonusScheme withoutTrashed()
 * @mixin \Eloquent
 */
	class BonusScheme extends \Eloquent {}
}

namespace App\Models\MBO{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $period
 * @property mixed|null $description
 * @property mixed $definition_from
 * @property mixed $definition_to
 * @property mixed $disposition_from
 * @property mixed $disposition_to
 * @property mixed $realization_from
 * @property mixed $realization_to
 * @property mixed $evaluation_from
 * @property mixed $evaluation_to
 * @property mixed $self_evaluation_from
 * @property mixed $self_evaluation_to
 * @property mixed $draft
 * @property mixed $manual
 * @property string $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $coordinators
 * @property-read int|null $coordinators_count
 * @property-read User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Objective> $objectives
 * @property-read int|null $objectives_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserCampaign> $user_campaigns
 * @property-read int|null $user_campaigns_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDefinitionFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDefinitionTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDispositionFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDispositionTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereEvaluationFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereEvaluationTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereRealizationFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereRealizationTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereSelfEvaluationFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereSelfEvaluationTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Campaign withoutTrashed()
 * @property string $stage
 * @mixin \Eloquent
 */
	class Campaign extends \Eloquent {}
}

namespace App\Models\MBO{
/**
 * 
 *
 * @property string $id
 * @property string|null $template_id
 * @property string|null $parent_id
 * @property string|null $campaign_id
 * @property string $name
 * @property mixed|null $description
 * @property mixed|null $deadline
 * @property string $weight
 * @property string|null $award
 * @property string|null $expected
 * @property mixed $draft
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Campaign|null $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Objective> $children
 * @property-read int|null $children_count
 * @property-read Objective|null $parent
 * @property-read ObjectiveTemplate|null $template
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UserObjective> $user_assignments
 * @property-read int|null $user_assignments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereAward($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereExpected($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Objective withoutTrashed()
 * @mixin \Eloquent
 */
	class Objective extends \Eloquent {}
}

namespace App\Models\MBO{
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
 * @method static \Database\Factories\MBO\ObjectiveTemplateFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 */
	class ObjectiveTemplate extends \Eloquent {}
}

namespace App\Models\MBO{
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
 * @property string|null $shortname
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $coordinators
 * @property-read int|null $coordinators_count
 * @mixin \Eloquent
 */
	class ObjectiveTemplateCategory extends \Eloquent {}
}

namespace App\Models\MBO{
/**
 * 
 *
 * @property string $id
 * @property string $user_id
 * @property string $bonus_scheme_id
 * @property string $campaign_id
 * @property int $score
 * @property User $approved_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read BonusScheme $bonus_scheme
 * @property-read Campaign $campaign
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereBonusSchemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserBonusAssignment withoutTrashed()
 * @mixin \Eloquent
 */
	class UserBonusAssignment extends \Eloquent {}
}

namespace App\Models\MBO{
/**
 * 
 *
 * @property string $id
 * @property string $campaign_id
 * @property string $user_id
 * @property string $stage
 * @property mixed $manual
 * @property mixed $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Campaign $campaign
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereManual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserCampaign withoutTrashed()
 * @mixin \Eloquent
 */
	class UserCampaign extends \Eloquent {}
}

namespace App\Models\MBO{
/**
 * 
 *
 * @property string $id
 * @property string $user_id
 * @property string $objective_id
 * @property UserObjectiveStatus $status
 * @property numeric|null $evaluation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Objective $objective
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereEvaluation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereObjectiveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserObjective withoutTrashed()
 * @mixin \Eloquent
 */
	class UserObjective extends \Eloquent {}
}

namespace App\Models\MBO{
/**
 * 
 *
 * @property int $id
 * @property string $user_id
 * @property string $subject_type
 * @property string $subject_id
 * @property string|null $points
 * @property string $assigned_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereAssignedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserPoints withoutTrashed()
 * @mixin \Eloquent
 */
	class UserPoints extends \Eloquent {}
}

