<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_files', function (Blueprint $table) {
            $table->increments('file_id')->comment('ID');
            $table->unsignedInteger('job_id')->comment('案件ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('file_name', 255)->comment('ファイル名');
            $table->string('file_path', 255)->comment('ファイルパス');
            $table->integer('file_status')->comment('ファイルステータス');
            $table->timestamps(); // updated_at & created_at

            // 外部キー制約
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
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
        Schema::dropIfExists('job_files');
    }
}
