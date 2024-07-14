<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use App\Facades\Forms\RequestForms;

class Role extends Model
{
    use UUID, HasFactory, RequestForms;

    protected $table = 'roles';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'slug',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    public static function getId(string $slug): ?string
    {
        $role = self::where('slug', $slug)->first();
        if(isset($role->id)){
            return $role->id;
        }

        return null;
    }

    public static function getSelectList(): array
    {
        $output = array();
        $roles = self::whereIn('slug', ['admin', 'admin_mbo'])->get();
        if(!$roles->isEmpty()){
            foreach ($roles as $role){
                $name = __('fields.roles.'.$role->slug);
                $output[$role->id] = $name;
            }
        }
        return $output;
    }
}
