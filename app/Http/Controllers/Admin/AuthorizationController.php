<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    use AuthenticatesUsers;

    public function permissionRoleCreate(Request $request)
    {
        return view('admin.authorize.permissionRole.create');
    }
}
