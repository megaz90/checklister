<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'is_admin' => true,
            'is_super_admin' => true,
        ]);

        User::create([
            'name' => 'furqan',
            'email' => 'furqan@gmail.com',
            'password' => bcrypt('furqan123'),
            'is_admin' => true,
        ]);
    }
}
