<?php

namespace App\Services\PermissionService;

use App\Models\ImplementedPermissions;
use App\Models\Permission;
use App\Models\Role;

class PermissionService
{
    public function createData()
    {
        $implemented_permissions = ImplementedPermissions::whereNull('permission_id')
            ->get()
            ->toArray();

        return $implemented_permissions;
    }

    public function storeData($request)
    {
        $permission = Permission::create([
            'name' => $request->name
        ]);

        $implemented_permission = ImplementedPermissions::find($request->implemented_id)
            ->update(['permission_id' => $permission->id]);

        //Super Admin seeded
        // $super_admin = Role::find(1);
        // $super_admin->permissions()->attach($permission->id);

        return true;
    }

    public function editData($permission)
    {
        $implemented_permissions = ImplementedPermissions::whereNull('permission_id')
            ->orWhere('permission_id', $permission->id)
            ->get()
            ->toArray();

        return $implemented_permissions;
    }

    public function updateData($request, $permission)
    {
        //Deleting Old Assigned Permission Id and assiging it NULL
        $old = ImplementedPermissions::find($permission->implemented_permission->id);
        $old->permission_id = null;
        $old->save();

        $permission->update(['name' => $request->name]);

        $implemented_permission = ImplementedPermissions::find($request->implemented_id)
            ->update(['permission_id' => $permission->id]);

        return true;
    }
}
