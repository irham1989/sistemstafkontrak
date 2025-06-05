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
        Schema::create('staff_academics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('staff_id');
            $table->integer('academic_qualification_id');
            $table->string('certificate_name');
            $table->text('institution_name');
            $table->text('institution_location');
            $table->text('major_specialization');
            $table->text('minor_specialization')->nullable();
            $table->text('professional_certification')->nullable();
            $table->date('professional_certification_date')->nullable();
            $table->string('overall_grade')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('academic_qualification_id')->references('id')->on('academic_qualifications')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_academics');
    }
};
