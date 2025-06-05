<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->integer('salutation_id')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->integer('postal_code')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('marital_status_id')->nullable();
            $table->integer('race_id')->nullable();
            $table->string('other_race')->nullable();
            $table->integer('bumiputera_id')->nullable();
            $table->string('bumiputera_other')->nullable();
            $table->integer('gender_id')->nullable();
            $table->date('dob')->nullable();
            $table->integer('age')->nullable();
            $table->integer('birth_country_id')->nullable();
            $table->integer('birth_state_id')->nullable();
            $table->integer('birth_certificate_no')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('race_id')->references('id')->on('races')->onDelete('cascade');
            $table->foreign('bumiputera_id')->references('id')->on('bumiputeras')->onDelete('cascade');
            $table->foreign('salutation_id')->references('id')->on('salutations')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->foreign('birth_country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('birth_state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
