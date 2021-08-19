<?php

namespace App\Services;

use App\Models\User;

class AuthorizationService
{
    /**
     * @param Model Instance 
     * @param String $type (Implemented Permission)
     * @return boolean
     */

    protected function check($model, string $type)
    {
        $user = auth()->user();
        $data = User::with('roles.permissions.implemented_permission')->find($user->id);
        if ($user->is_super_admin == TRUE) {
            return true;
        }

        foreach ($data->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->implemented_permission == null) {
                    return false;
                }
                if ($permission->implemented_permission->name === $type) {
                    return true;
                }
            }
        }
    }
}
