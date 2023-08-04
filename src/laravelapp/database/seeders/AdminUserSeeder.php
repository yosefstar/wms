<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => 'Admin User',
            'password' => Hash::make('admin_password'),
            'user_type' => 1,
            'user_nickname' => 'Admin',
            'email' => 'admin@example.com',
            'stop_flag' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
