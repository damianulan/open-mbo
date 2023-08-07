<?php

namespace App\Models\MBO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ProcessStage;

class UserProcess extends Model
{
    use HasFactory, UUID, SoftDeletes;

}
