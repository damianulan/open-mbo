<?php

namespace App\Traits;

use App\Models\Core\Role;
use App\Models\Core\Permission;
use Illuminate\Support\Collection;
use App\Models\MBO\Campaign;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Contexts\System;
use Illuminate\Database\Eloquent\Builder;
trait HasRolesAndPermissions
{
    /**
     * @return mixed
     */
    public function roles($context = null)
    {
        $relation = $this->belongsToMany(Role::class,'users_roles');
        if($context && $context instanceof Model){
            $system_context = new System();
            $relation = $this->belongsToMany(Role::class,'users_roles')->where(function(Builder $q) use ($context, $system_context){
                $q->where(['context_type' => $context::class, 'context_id' => $context->id])
                    ->orWhere(['context_type' => $system_context::class]);
            });
        }
        return $relation;
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
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
        foreach($slugs as $slug){
            $roles->push(__('fields.roles.'.$slug));
        }
        return $roles;
    }

    /**
    * @param mixed ...$roles
    * @return bool
    */
    public function hasRole(... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasAnyRole(... $roles)
    {
        foreach($roles as $role){
            if($this->hasRole($role)){
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission, $context = null)
    {
        return $this->hasPermissionThroughRole($permission, $context) || $this->hasPermission($permission);
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionThroughRole($permission, $context = null)
    {
        foreach ($permission->roles as $role){
            if($this->roles($context)->get()->contains($role)) {
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
        return Permission::where('slug',$permissions)->get();
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function assignRole($role, $context = null)
    {
        $id = Role::getId($role);
        if($id){
            $additional = array();
            if(!$context || !($context instanceof Model)){
                $context = new System();
            }
            $additional['context_type'] = $context::class;
            $additional['context_id'] = $context->id;

            $this->roles()->attach($id, $additional);
        }
        return true;
    }

    public function revokeRole($role, $context = null)
    {
        $id = Role::getId($role);
        if($id){
            $additional = array();
            if(!$context || !($context instanceof Model)){
                $context = new System();
            }
            $additional['context_type'] = $context::class;
            $additional['context_id'] = $context->id;
            $this->roles()->detach($id, $additional);
        }
        return true;
    }

    public function refreshRole($roles_ids)
    {
        // TODO

        return true;
    }

    public function isMBOAdmin()
    {
        return $this->hasAnyRole('root', 'support', 'admin', 'admin_mbo');
    }

    public function isAdmin()
    {
        return $this->hasAnyRole('root', 'support', 'admin');
    }

    public function isRoot()
    {
        return $this->hasAnyRole('root', 'support');
    }

    public function isCampaignCoordinator(Campaign $campaign)
    {
        return $campaign->coordinators()->contains('coordinator_id', $this->id);
    }
}
