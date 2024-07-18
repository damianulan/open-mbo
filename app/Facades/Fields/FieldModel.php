<?php

namespace App\Facades\Fields;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Facades\Forms\RequestForms;

class FieldModel extends Model
{
    use UUID, RequestForms;

    protected $table = 'facades_fields';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'slug',
    ];

}
