<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    use AuthenticatesUsers;

    public function permissionRoleCreate()
    {
        $roles = Role::all()->toArray();
        $permissions = Permission::all();

        return view('admin.authorize.permissionRole.create', compact(['roles', 'permissions']));
    }

    public function permissionRoleStore(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'permission_ids' => 'required'
        ]);

        $role = Role::find($request->role_id);

        $arr = [];
        foreach ($role->permissions as $permission) {
            $arr[] = $permission->id;       // Creating New Array in order to compare it with incoming request array
        }

        //Making an array of only those permission IDs which are not saved in DB before.
        $result = array_diff($request->permission_ids, $arr);

        if (count($result) > 0) {
            foreach ($result as $permission_id) {
                $role->permissions()->attach($permission_id);
            }
        }
        return redirect()->back();
    }

    public function getPermissions($id)
    {
        $role = Role::find($id);
        $arr = [];
        foreach ($role->permissions as $permission) {
            $arr[] = $permission->id;
        }
        return response()->json($arr);
    }
}
