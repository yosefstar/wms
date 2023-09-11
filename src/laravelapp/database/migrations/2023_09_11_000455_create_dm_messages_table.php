<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id'); // 送信者のユーザーID
            $table->unsignedBigInteger('receiver_id'); // 受信者のユーザーID
            $table->text('content'); // メッセージの内容
            $table->unsignedBigInteger('job_id'); // 関連する案件のID
            $table->timestamps(); // created_at および updated_at カラムを自動生成

            // 外部キー制約
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            // 仮に jobs テーブルとの外部キー制約も必要な場合は追加してください
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dm_messages');
    }
}
