<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\ImplementedPermissions;
use App\Models\Permission;
use App\Models\Role;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::latest()->paginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $implemented_permissions = ImplementedPermissions::whereNull('permission_id')
            ->get()
            ->toArray();

        return view('admin.permission.create', compact('implemented_permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create([
            'name' => $request->name
        ]);

        $implemented_permission = ImplementedPermissions::find($request->implemented_id)
            ->update(['permission_id' => $permission->id]);

        //Super Admin seeded
        $super_admin = Role::find(1);
        $super_admin->permissions()->attach($permission->id);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $implemented_permissions = ImplementedPermissions::whereNull('permission_id')
            ->orWhere('permission_id', $permission->id)
            ->get()
            ->toArray();

        return view('admin.permission.edit', compact('permission', 'implemented_permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        //Deleting Old Assigned Permission Id and assiging it NULL
        $old = ImplementedPermissions::find($permission->implemented_permission->id);
        $old->permission_id = null;
        $old->save();

        $permission->update(['name' => $request->name]);

        $implemented_permission = ImplementedPermissions::find($request->implemented_id)
            ->update(['permission_id' => $permission->id]);

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
