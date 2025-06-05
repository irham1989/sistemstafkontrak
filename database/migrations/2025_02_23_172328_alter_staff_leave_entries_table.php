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
        Schema::table('staff_leave_entries', function (Blueprint $table) {
           $table->unsignedBigInteger('approver_id')->nullable()->after('staff_position_id');
           $table->foreign('approver_id')->references('id')->on('staffs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
