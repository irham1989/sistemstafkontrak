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
        Schema::create('weekend_holidays', function (Blueprint $table) {
            $table->id();
            $table->integer('state_id');
            $table->integer('day_id');
            $table->boolean('deleted')->default(false);
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekend_holidays');
    }
};
