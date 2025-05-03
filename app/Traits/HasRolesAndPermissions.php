<?php

namespace App\Traits;

use App\Models\Core\Role;
use App\Models\Core\Permission;
use App\Enums\Core\PermissionLib;
use Illuminate\Support\Collection;
use App\Models\MBO\Campaign;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Contexts\System;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as DBBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait HasRolesAndPermissions
{
    /**
     * Context is not required, if not provided, checks for all contexts. System context is superior - if context is provided,
     * but assigned to System context, then it will return true.
     *
     * @param  mixed $context - \Illuminate\Database\Eloquent\Model instance
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles($context = null): BelongsToMany
    {
        $relation = $this->belongsToMany(Role::class, 'users_roles');
        if ($context && $context instanceof Model) {
            $system_context = new System();
            $relation = $this->belongsToMany(Role::class, 'users_roles')->where(function (Builder $q) use ($context, $system_context) {
                $q->where(['context_type' => $context::class, 'context_id' => $context->id])
                    ->orWhere(['context_type' => $system_context::class]);
            });
        }
        return $relation;
    }

    /**
     * users_roles raw db representation
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function roleAssignments(): DBBuilder
    {
        $builder = DB::table('users_roles')->where('user_id', $this->id);

        return $builder;
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * Returns a Colletion of slugs with user roles being assigned to him.
     *
     * @return Collection
     */
    public function getRoles(): Collection
    {
        return $this->roles->pluck('slug');
    }

    /**
     * Returns a Colletion of user's roles names based on langs.
     *
     * @return Collection
     */
    public function getRolesNames(): Collection
    {
        $slugs = $this->roles->pluck('slug');
        $roles = new Collection();
        foreach ($slugs as $slug) {
            $roles->push(__('gates.roles.' . $slug));
        }
        return $roles;
    }

    /**
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasAnyRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param  Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission)
    {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    /**
     * Check if user has a certain permission (direct or through role). Give model context if needed.
     * Use "permission-*" syntax to check for multiple permissions of given category.
     *
     * @param  Permission|string $permission
     * @param  mixed             $context
     * @return bool
     */
    public function hasPermissionTo(Permission|string $permission, $context = null)
    {
        $perm = $permission;
        if ($permission instanceof Permission) {
            $perm = $permission->slug;
        }

        $permissions = $this->getMultiplePermissions($perm);
        $result = false;

        foreach ($permissions as $p) {
            $result = $this->hasPermissionThroughRole($p, $context) || $this->hasPermission($p);
            if ($result) {
                break;
            }
        }
        return $result;
    }


    /**
     * @param  Permission $permission
     * @param  mixed      $context
     * @return bool
     */
    public function hasPermissionThroughRole(Permission $permission, $context = null)
    {
        $roles = $this->roles($context)->get();
        foreach ($permission->roles as $role) {
            if ($roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array $permissions
     * @return mixed
     */
    public function getAllPermissions(array $permissions)
    {
        return Permission::where('slug', $permissions)->get();
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function assignRoleSlug($slug, $context = null)
    {
        if (!$slug instanceof Role) {
            $role = Role::findBySlug($slug);
        }
        if ($role) {
            return $this->assignRoleType($role, $context);
        }
        return true;
    }

    public function assignRole($role_id, $context = null)
    {
        if (!$role_id instanceof Role) {
            $role = Role::find($role_id);
        } else {
            $role = $role_id;
        }

        if ($role) {
            return $this->assignRoleType($role, $context);
        }
        return true;
    }

    public function revokeRoleSlug($slug, $context = null)
    {
        if (!$slug instanceof Role) {
            $role = Role::findBySlug($slug);
        } else {
            $role = $slug;
        }

        if ($role) {
            $this->revokeRoleType($role, $context);
        }
        return true;
    }

    public function revokeRole($role_id, $context = null)
    {
        if (!$role_id instanceof Role) {
            $role = Role::find($role_id);
        } else {
            $role = $role_id;
        }

        if ($role) {
            $this->revokeRoleType($role, $context);
        }
        return true;
    }

    private function assignRoleType(Role $role, $context = null)
    {
        $additional = array();

        if (!$context || !($context instanceof Model)) {
            $context = new System();
        }
        $additional['context_type'] = $context::class;
        $additional['context_id'] = $context->id;

        $this->roles()->attach($role, $additional);
    }

    private function revokeRoleType(Role $role, $context = null)
    {
        $additional = array();

        if (!$context || !($context instanceof Model)) {
            $context = new System();
        }
        $additional['context_type'] = $context::class;
        $additional['context_id'] = $context->id;

        $this->roles()->detach($role, $additional);
    }

    public function refreshRole($roles_ids = null)
    {
        if (!$roles_ids) {
            $roles_ids = array();
        }

        $current = $this->roles()->where('assignable', 1)->get()->pluck('id')->toArray();

        $toDelete = array_filter($current, function ($value) use ($roles_ids) {
            return !in_array($value, $roles_ids);
        });
        $toAdd = array_filter($roles_ids, function ($value) use ($current) {
            return !in_array($value, $current);
        });

        foreach ($toDelete as $role_id) {
            $this->revokeRole($role_id);
        }
        foreach ($toAdd as $role_id) {
            $this->assignRole($role_id);
        }

        return true;
    }

    /**
     * @param  string $permission
     * @return array
     */
    private function getMultiplePermissions(string $permission): array
    {
        $permissions = array();
        $m = array();
        $str = Str::of($permission);
        if ($str->contains('-*')) {
            $needle = $str->beforeLast('-*');
            $all = array_keys(PermissionLib::normal());
            $matches = array_filter($all, function ($value) use ($needle) {
                return Str::of($value)->contains($needle);
            });
            if (!empty($matches)) {
                $m = Permission::whereIn('slug', $matches)->get();
            }
        } else {
            $m = Permission::whereIn('slug', array($permission))->get();
        }

        if (!empty($m)) {
            $permissions = $m->all();
        }

        return $permissions;
    }

    public function isMBOAdmin()
    {
        return $this->hasAnyRole('root', 'support', 'admin', 'admin_mbo');
    }

    public function isAdmin()
    {
        return $this->hasAnyRole('root', 'support', 'admin');
    }

    public function isRoot(bool $strict = false)
    {
        if ($strict) {
            return $this->hasAnyRole('root');
        }
        return $this->hasAnyRole('root', 'support');
    }

    public function isCampaignCoordinator(Campaign $campaign)
    {
        return $campaign->coordinators()->contains('coordinator_id', $this->id);
    }
}
