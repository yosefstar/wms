<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dm', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->unsignedInteger('job_id')->comment('案件ID');
            $table->text('content')->nullable(false)->comment('内容');
            $table->integer('dm_status')->default(1)->nullable(false)->comment('ユーザー間でのやり取りか、案件間でのやり取りかを判別。');
            $table->timestamps(); // updated_at & created_at

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dm');
    }
}
