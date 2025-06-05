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
        Schema::create('staff_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_position_id')->index();
            $table->float('leave_total')->default(0);
            $table->float('leave_taken')->default(0);
            $table->float('leave_balance')->default(0);
            $table->foreign('staff_position_id')->references('id')->on('staff_positions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_leaves');
    }
};
