<?php

namespace App\Policies;

use App\Models\User;
use App\Services\AuthorizationService\AuthorizationService;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionRolePolicy extends AuthorizationService
{
    use HandlesAuthorization;

    public function viewAny($permission_role)
    {
        $data = $this->check($permission_role, "permission_to_role_access");
        return $data == true;
    }

    public function create($permission_role)
    {
        $data = $this->check($permission_role, "permission_to_role_create");
        return $data == true;
    }

    public function update($permission_role)
    {
        $data = $this->check($permission_role, "permission_to_role_edit");
        return $data == true;
    }
}
