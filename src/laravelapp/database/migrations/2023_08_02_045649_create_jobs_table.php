<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedBigInteger('job_contractor_id')->comment('ユーザーID(案件受注者)');
            $table->unsignedBigInteger('job_client_id')->comment('ユーザーID(案件発注者)');
            $table->string('job_name', 255)->nullable(false)->comment('案件名');
            $table->text('job_details')->comment('案件詳細');
            $table->integer('job_status')->length(2)->default(1)->nullable(false)->comment('案件ステータス。未対応、対応中、納品済、検収済の4つ。');
            $table->integer('job_reward')->length(10)->comment('案件報酬');
            $table->integer('job_travel_cost')->length(10)->comment('案件交通費');
            $table->integer('job_expense')->length(10)->comment('案件経費');
            $table->dateTime('job_end_date')->comment('案件納品日');
            $table->dateTime('job_check_date')->comment('案件検修日');
            $table->timestamps(); // created_at & updated_at

            // 外部キー制約
            $table->foreign('job_contractor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_client_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
