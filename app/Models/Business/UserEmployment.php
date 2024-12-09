<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Traits\Vendors\TrixFields;
use App\Models\Core\User;
use App\Models\Business\Company;
use App\Models\Business\Department;
use App\Models\Business\Position;
use App\Models\Business\Team;
use App\Models\Business\TypeOfContract;
use App\Casts\Carbon\CarbonDate;
use App\Casts\CheckboxCast;

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
class UserEmployment extends BaseModel
{
    use TrixFields;

    protected $fillable = [
        'foreign_id',
        'user_id',
        'company_id',
        'contract_id',
        'department_id',
        'position_id',

        'employment',
        'release',
    ];

    protected $casts = [
        'employment' => CarbonDate::class,
        'release' => CarbonDate::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contract()
    {
        return $this->belongsTo(TypeOfContract::class, 'contract_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function team()
    {

    }
}
