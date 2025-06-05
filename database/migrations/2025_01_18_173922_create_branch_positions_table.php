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
        Schema::create('branch_positions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->index();
            $table->string('position');
            $table->string('grade');
            $table->float('default_holiday')->default(0);
            $table->boolean('deleted')->default(false);
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_positions');
    }
};
