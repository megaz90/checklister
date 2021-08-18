<?php

namespace Database\Seeders;

use App\Models\ImplementedPermissions;
use Illuminate\Database\Seeder;

class ImplementedPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user_access',
            'user_create',
            'user_show',
            'user_delete',
            'user_edit',
            'role_access',
            'role_create',
            'role_show',
            'role_delete',
            'role_edit',
            'permission_access',
            'permission_create',
            'permission_show',
            'permission_delete',
            'permission_edit',
            'checklist_group_access',
            'checklist_group_create',
            'checklist_group_show',
            'checklist_group_delete',
            'checklist_group_edit',
            'checklist_access',
            'checklist_create',
            'checklist_show',
            'checklist_delete',
            'checklist_edit',
        ];

        foreach ($permissions as $permission) {
            ImplementedPermissions::create([
                'name' => $permission
            ]);
        }
    }
}
