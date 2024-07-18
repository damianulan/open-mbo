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
