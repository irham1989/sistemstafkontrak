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
        Schema::create('public_holidays', function (Blueprint $table) {
            $table->id();
            $table->integer('state_id');
            $table->string('name');
            $table->date('h_date');
            $table->integer('month')->nullable();
            $table->string('h_type')->nullable();
            $table->integer('h_type_id')->nullable();
            $table->boolean('is_holiday')->default(false);
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_holidays');
    }
};
