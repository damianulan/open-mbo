<?php

namespace App\Facades\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class ModuleModel extends Model
{
    use UUID;

    protected $table = 'modules';

    protected $fillable = [
        'name',
        'category',
        'icon',
        'active',
        'order'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
