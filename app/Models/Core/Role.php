<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Lucent\Support\Traits\UUID;
use FormForge\Traits\RequestForms;
use Illuminate\Database\Eloquent\Builder;

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
class Role extends Model
{
    use UUID, HasFactory, RequestForms;

    protected $table = 'roles';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'slug',
        'assignable',
    ];

    protected $casts = [
        'assignable' => 'boolean',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public static function findBySlug(string $slug): ?self
    {
        return self::whereSlug($slug)->first();
    }

    public static function getId(string $slug): ?string
    {
        $role = self::whereSlug($slug)->first();
        if (isset($role->id)) {
            return $role->id;
        }

        return null;
    }

    public static function getBySlug(string $slug): ?self
    {
        return self::where('slug', $slug)->first();
    }

    public static function getSelectList(): array
    {
        $output = array();
        $roles = self::where('assignable', 1)->get();
        if (!$roles->isEmpty()) {
            foreach ($roles as $role) {
                $name = __('gates.roles.' . $role->slug);
                $output[$role->id] = $name;
            }
        }
        return $output;
    }

    public function scopeWhereSlug(Builder $query, string $slug): void
    {
        $query->where('slug', $slug);
    }

    public function scopeWhereAssignable(Builder $query): void
    {
        $query->where('assignable', 1);
    }
}
