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
        Schema::table('branch_positions', function (Blueprint $table) {
            $table->unsignedBigInteger('position_id')->nullable()->after('branch_id');
            $table->unsignedBigInteger('grade_id')->nullable()->after('position_id');

            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('grade_id')->references('id')->on('grades');
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
