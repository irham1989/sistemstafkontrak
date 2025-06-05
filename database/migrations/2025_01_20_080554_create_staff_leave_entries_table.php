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
        Schema::create('staff_leave_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_position_id')->index();
            $table->unsignedBigInteger('staff_leave_id')->index();
            $table->integer('leave_category_id')->index();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('leave_request_status_id')->index();
            $table->timestamps();

            $table->foreign('staff_position_id')->references('id')->on('staff_positions')->onDelete('cascade');
            $table->foreign('staff_leave_id')->references('id')->on('staff_leaves')->onDelete('cascade');
            $table->foreign('leave_category_id')->references('id')->on('leave_categories');
            $table->foreign('leave_request_status_id')->references('id')->on('leave_request_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_leave_entries');
    }
};
