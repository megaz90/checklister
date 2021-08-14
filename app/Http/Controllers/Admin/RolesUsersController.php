<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesUsersRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class RolesUsersController extends Controller
{
    public function roleUserCreate()
    {
        $roles = Role::all()->toArray();
        if (auth()->user()->is_super_admin == TRUE) {
            $users = User::all()->toArray();
        } else {
            $users = User::where('is_super_admin', 0)
                ->where('id', '!=', auth()->user()->id)
                ->get()
                ->toArray();
        }

        return view('admin.authorize.roleUser.create', compact(['roles', 'users']));
    }

    public function roleUserStore(RolesUsersRequest $request)
    {
        $user = User::find($request->user_id);

        $arr = [];
        foreach ($user->roles as $role) {
            $arr[] = $role->id;       // Creating New Array in order to compare it with incoming request array
        }

        //Making an array of only those permission IDs which are not saved in DB before.
        $result = array_diff($request->role_ids, $arr);

        if (count($result) > 0) {
            foreach ($result as $role_id) {
                $user->roles()->attach($role_id);
            }
        }
        return redirect()->back();
    }

    public function getRoles($id)
    {
        $user = User::find($id);
        $arr = [];
        foreach ($user->roles as $role) {
            $arr[] = $role->id;
        }
        return response()->json($arr);
    }

    public function roleUserEdit()
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.authorize.roleUser.edit', compact(['users', 'roles']));
    }

    public function roleUserUpdate(RolesUsersRequest $request)
    {
        $users = User::with('roles')->get();

        foreach ($users as $user) {
            if ($user->id == $request->user_id) {
                $user->roles()->sync($request->role_ids);
            }
        }
        return redirect()->back();
    }
}
