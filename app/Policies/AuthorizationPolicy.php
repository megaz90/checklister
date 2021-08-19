<?php

namespace App\Policies;

use App\Models\User;
use App\Services\AuthorizationService;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorizationPolicy extends AuthorizationService
{
    use HandlesAuthorization;

    public function viewAny($authorization)
    {
        $data = $this->check($authorization, "authorization_access");
        return $data == true;
    }
}
