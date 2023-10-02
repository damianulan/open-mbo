<?php

namespace App\Facades\Logger;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Activity extends Model
{
    protected $table = 'activity_log';
    protected $primaryKey = 'id';

    protected $fillable = [
        'causer_id',
        'object',
        'method',
        'action',
        'url',
        'description',
        'ip_address'
    ];

    protected $casts = [

    ];

    public function log(string $action, string $description_lang = null)
    {
        $user = User::find(Auth::user()->id);
        $description = null;
        if($description_lang){
            $lang = __('logging.activity.'.$description_lang);
            if($lang && !empty($lang)){
                $description = $lang;
            }
        }
        $backtrace = debug_backtrace()[1];
        $log = new self();
        $log->causer_id = $user->id;
        $log->object = $backtrace['class'];
        $log->method = $backtrace['function'];
        $log->action = $action;
        $log->url = URL::full();
        $log->description = $description;
        $log->save();
    }

}
