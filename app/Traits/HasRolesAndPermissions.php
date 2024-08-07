<?php

namespace App\Traits;

use App\Models\Core\Role;
use App\Models\Core\Permission;
use Illuminate\Support\Collection;

trait HasRolesAndPermissions
{
    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
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
                if($role === 'supervisor'){
                    if(!$this->isSupervisor()){
                        $this->revokeRole('supervisor');
                        return false;
                    }
                }
                elseif($role === 'manager'){
                    if(!$this->isManager()){
                        $this->revokeRole('manager');
                        return false;
                    }
                }
                return true;
            }
            elseif($role === 'supervisor'){
                if($this->isSupervisor()){
                    $this->assignRole('supervisor');
                    return true;
                }
            }
            elseif($role === 'manager'){
                if($this->isManager()){
                    $this->assignRole('manager');
                    return true;
                }
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
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
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

    /**
     * @param array $roles
     * @return HasRolesAndPermissions
     */
    public function refreshRole(array $roles )
    {
        return $this->roles()->sync($roles);
    }

    public function assignRole(... $roles)
    {
        foreach($roles as $role){
            $id = Role::getId($role);
            if($id){
                $this->roles()->attach($id);
            }
        }
        return true;
    }

    public function revokeRole(... $roles)
    {
        foreach($roles as $role){
            $id = Role::getId($role);
            if($id){
                $this->roles()->detach($id);
            }
        }
        return true;
    }
}
