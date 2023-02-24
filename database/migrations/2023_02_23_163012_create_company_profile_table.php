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
        Schema::create('company_profile', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->text('company_registered_business')->nullable();
            $table->bigInteger('zip_registered_address')->nullable();
            $table->bigInteger('city_registered_address')->nullable();
            $table->bigInteger('country_registered_address')->nullable();
            $table->bigInteger('state_registered_address')->nullable();
            $table->text('company_correspondence_address')->nullable();
            $table->bigInteger('zip_correspondence_address')->nullable();
            $table->bigInteger('city_correspondence_address')->nullable();
            $table->bigInteger('country_correspondence_address')->nullable();
            $table->bigInteger('state_correspondence_address')->nullable();
            $table->string('company_correspondence_email')->nullable();
            $table->string('company_correspondence_telephone')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('tax_registration_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('company_logo')->nullable();
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
        Schema::dropIfExists('company_profile');
    }
};
