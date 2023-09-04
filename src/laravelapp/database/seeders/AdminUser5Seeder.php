<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUser5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => 'Admin User5',
            'password' => Hash::make('admin5@example.com'),
            'user_type' => 1,
            'user_nickname' => 'Admin5',
            'email' => 'admin5@example.com',
            'stop_flag' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
