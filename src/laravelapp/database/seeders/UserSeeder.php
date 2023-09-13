<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'user_name' => '管理者1',
                'password' => Hash::make('user1@example.com'),
                'user_type' => 1,
                'user_nickname' => '管理者 1',
                'email' => 'user1@example.com',
                'stop_flag' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => '管理者2',
                'password' => Hash::make('user2@example.com'),
                'user_type' => 1,
                'user_nickname' => '管理者 2',
                'email' => 'user2@example.com',
                'stop_flag' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 他のデータも同様に追加
        ]);

        DB::table('users')->insert([
            [
                'user_name' => 'ライター1',
                'password' => Hash::make('user3@example.com'),
                'email' => 'user3@example.com',
                'user_type' => 2,
                'user_nickname' => 'ライター1',
                'stop_flag' => 0,
                'postal_code' => '123-4567',
                'prefecture_id' => 1,
                'city' => 'Tokyo',
                'street_address' => '1-2-3 Example Street',
                'building_and_room' => 'Apt 101',
                'user_phone_number' => '123-456-7890',
                'bank_name' => 'Example Bank',
                'branch_name' => 'Tokyo Branch',
                'bank_account_type' => 'Savings',
                'bank_account_number' => '12345678',
                'bank_account_holder_name' => 'User1 Holder',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'ライター2',
                'password' => Hash::make('user4@example.com'),
                'email' => 'user4@example.com',
                'user_type' => 2,
                'user_nickname' => 'ライター2',
                'stop_flag' => 0,
                'postal_code' => '987-6543',
                'prefecture_id' => 2,
                'city' => 'Osaka',
                'street_address' => '4-5-6 Another Street',
                'building_and_room' => 'Unit 202',
                'user_phone_number' => '987-654-3210',
                'bank_name' => 'Another Bank',
                'branch_name' => 'Osaka Branch',
                'bank_account_type' => 'Checking',
                'bank_account_number' => '87654321',
                'bank_account_holder_name' => 'User2 Holder',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 20個のジョブを作成
        for ($i = 1; $i <= 20; $i++) {
            $jobContractorId = ($i % 2 === 0) ? 4 : 3; // job_contractor_idが1または2
            $jobClientId = ($i % 2 === 0) ? 2 : 1; // job_client_idが3または4
            $jobStatus = rand(1, 4); // 1から4までのランダムな値
            $jobEndDate = ($jobStatus >= 2) ? now()->addDays(rand(5, 14)) : null;
            $jobCheckDate = ($jobStatus === 4) ? now()->month(rand(7, 9))->day(rand(1, 28))->hour(rand(0, 23))->minute(rand(0, 59))->second(rand(0, 59)) : null;

            DB::table('jobs')->insert([
                'job_contractor_id' => $jobContractorId,
                'job_client_id' => $jobClientId,
                'job_name' => "案件{$i}",
                'job_details' => "案件{$i}の詳細情報",
                'job_status' => $jobStatus,
                'job_reward' => rand(1000, 10000),
                'job_travel_cost' => rand(0, 5000),
                'job_expense' => rand(0, 5000),
                'job_end_date' => $jobEndDate,
                'job_check_date' => $jobCheckDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 5個のお知らせを作成
        for ($i = 1; $i <= 5; $i++) {
            DB::table('announcements')->insert([
                'user_id' => rand(1, 2), // user_idを1か2に設定
                'title' => "お知らせ{$i}", // お知らせのタイトル
                'content' => "これはお知らせ{$i}の内容です。",
                'start_date' => now()->subDays(rand(0, 10)), // 本日から10日以内の日付
                'end_date' => now()->addDays(rand(1, 10)), // 本日から10日以内の日付
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
