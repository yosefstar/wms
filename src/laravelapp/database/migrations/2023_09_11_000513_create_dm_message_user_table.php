<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmMessageUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm_message_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dm_message_id'); // DM メッセージのID
            $table->unsignedBigInteger('user_id'); // ユーザーのID
            $table->timestamps(); // created_at および updated_at カラムを自動生成

            // ユーザーと DM メッセージの関連付けに対する外部キー制約
            $table->foreign('dm_message_id')->references('id')->on('dm_messages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dm_message_user');
    }
}
