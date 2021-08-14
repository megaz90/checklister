<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionsRolesRequest;
use App\Http\Requests\UpdatePermissionRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class PermissionsRolesController extends Controller
{
    public function permissionRoleCreate()
    {
        if (auth()->user()->is_super_admin == TRUE) {
            $roles = Role::all()->toArray();
        } else {
            $roles = Role::where('id', '!=', 1)
                ->get()
                ->toArray();
        }

        $permissions = Permission::all();

        return view('admin.authorize.permissionRole.create', compact(['roles', 'permissions']));
    }

    public function permissionRoleStore(PermissionsRolesRequest $request)
    {
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

    public function permissionRoleEdit()
    {
        if (auth()->user()->is_super_admin == TRUE) {
            $roles = Role::all();
        } else {
            $roles = Role::where('id', '!=', 1)
                ->get();
        }
        $permissions = Permission::all();

        return view('admin.authorize.permissionRole.edit', compact(['roles', 'permissions']));
    }

    public function permissionRoleUpdate(UpdatePermissionRoleRequest $request)
    {
        $roles = Role::with('permissions')->get();

        foreach ($roles as $role) {
            if ($role->id == $request->role_id) {
                $role->permissions()->sync($request->permission_ids);
            }
        }
        return redirect()->back();
    }
}
