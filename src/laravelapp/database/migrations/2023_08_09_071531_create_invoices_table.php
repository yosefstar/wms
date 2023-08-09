<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID(案件発注者)');
            $table->string('file_name', 255)->comment('ファイル名');
            $table->string('file_path', 255)->comment('ファイルパス');
            $table->integer('submit_status')->default(null)->comment('提出ステータス');
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
        Schema::dropIfExists('invoices');
    }
}
