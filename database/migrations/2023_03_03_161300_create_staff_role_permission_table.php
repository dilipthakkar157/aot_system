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
        Schema::create('staff_role_permission', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('staff_role_id');
            $table->tinyInteger('permission')->comment('1=Read/View,2=Edit,3=Delete,4=User Management');
            $table->text('staff_action_ids');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_role_permission');
    }
};
