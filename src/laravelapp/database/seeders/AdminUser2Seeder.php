<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUser2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => 'Admin User 2', // ユーザー名を変更
            'password' => Hash::make('admin_password'), // パスワードを変更
            'user_type' => 1,
            'user_nickname' => 'Admin 2', // ニックネームを変更
            'email' => 'admin2@example.com', // メールアドレスを変更
            'stop_flag' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
