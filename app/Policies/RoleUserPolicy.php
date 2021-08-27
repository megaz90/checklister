<?php

namespace App\Policies;

use App\Models\User;
use App\Services\AuthorizationService\AuthorizationService;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoleUserPolicy extends AuthorizationService
{
    use HandlesAuthorization;

    public function viewAny($role_user)
    {
        $data = $this->check($role_user, "role_to_user_access");
        return $data == true;
    }

    public function create($role_user)
    {
        $data = $this->check($role_user, "role_to_user_create");
        return $data == true;
    }

    public function update($role_user)
    {
        $data = $this->check($role_user, "role_to_user_edit");
        return $data == true;
    }
}
