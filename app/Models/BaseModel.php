<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Facades\Forms\RequestForms;
use Watson\Rememberable\Rememberable;
use App\Facades\Logger\Loggable;

class BaseModel extends Model
{
    use HasFactory, UUID, SoftDeletes, RequestForms;
    // use Loggable; TODO
    //use Rememberable;
}
