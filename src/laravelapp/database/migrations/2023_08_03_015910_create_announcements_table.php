<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('title', 255)->nullable(false)->comment('タイトル');
            $table->text('content')->comment('内容');
            $table->dateTime('start_date')->comment('開始日');
            $table->dateTime('end_date')->comment('終了日');
            $table->timestamps(); // updated_at & created_at

            // 外部キー制約
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
        Schema::dropIfExists('announcements');
    }
}
