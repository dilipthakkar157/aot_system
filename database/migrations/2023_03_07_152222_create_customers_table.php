<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth', 255)->nullable();
            $table->string('social_security_number', 255)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('three_latter_code', 3)->nullable();
            $table->string('password', 32)->nullable();
            $table->string('photo', 50)->nullable();
            $table->string('reset_token', 255)->nullable();
            $table->dateTime('reset_token_date_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
