<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Services\AuthorizationService;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy extends AuthorizationService
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($role)
    {
        $data = $this->check($role, "role_access");
        return $data == true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($role)
    {
        $data = $this->check($role, "role_show");
        return $data == true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($role)
    {
        $data = $this->check($role, "role_create");
        return $data == true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($role)
    {
        $data = $this->check($role, "role_edit");
        return $data == true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
