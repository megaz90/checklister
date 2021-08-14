<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Create User']);
        Permission::create(['name' => 'Show Users']);
        Permission::create(['name' => 'Assign Roles to Users']);
        Permission::create(['name' => 'Edit Roles Users']);
    }
}
