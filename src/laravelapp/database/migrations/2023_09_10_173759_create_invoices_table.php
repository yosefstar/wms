<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID(案件発注者)');
            $table->string('file_name', 255)->comment('ファイル名');
            $table->string('file_path', 255)->comment('ファイルパス');
            $table->string('billing_month', 255)->nullable()->comment('請求月');
            $table->integer('submit_status')->default(null)->comment('提出ステータス');
            $table->timestamps(); // updated_at & created_at

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
}
