<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function permissionRoleCreate()
    {
        return view('admin.authorize.permissionRole.create');
    }
}
