<?php

namespace App\Facades\Logger;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Log extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'causer_id',
        'model_id',
        'model',
        'action',
        'changes',
        'ip_address',
        'description',
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function model()
    {
        return $this->belongsTo($this->model::class, 'model_id');
    }

}
