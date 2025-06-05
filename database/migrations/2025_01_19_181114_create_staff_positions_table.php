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
        Schema::create('staff_positions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->index();
            $table->unsignedBigInteger('branch_position_id')->index();
            $table->unsignedBigInteger('branch_id')->index();
            $table->boolean('deleted')->default(false);

            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('branch_position_id')->references('id')->on('branch_positions')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_positions');
    }
};
