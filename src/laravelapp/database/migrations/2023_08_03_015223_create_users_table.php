<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 45)->unique();
            $table->string('password', 255);
            $table->string('email', 100)->unique();
            $table->integer('user_type');
            $table->string('user_nickname', 50);
            $table->string('user_icon', 255)->nullable();
            $table->integer('stop_flag')->default(1);
            $table->string('postal_code', 8)->nullable();
            $table->integer('prefecture_id')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('street_address', 255)->nullable();
            $table->string('building_and_room', 255)->nullable();
            $table->string('user_phone_number', 15)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('branch_name', 100)->nullable();
            $table->string('bank_account_type', 20)->nullable();
            $table->string('bank_account_number', 20)->nullable();
            $table->string('bank_account_holder_name', 100)->nullable();
            $table->timestamps(); // created_atとupdated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
