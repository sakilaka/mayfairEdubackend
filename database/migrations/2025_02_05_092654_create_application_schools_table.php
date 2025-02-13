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
        Schema::create('application_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('student_applications')->onDelete('cascade');
            $table->year('year_of_completion');
            $table->string('degree_name');
            $table->string('student_roll_number');
            $table->string('major_subject');
            $table->string('cgpa');
            $table->date('certificate_issue_date');
            $table->string('school_university');
            $table->string('country_of_completion');
            $table->string('institution_address');
            $table->string('institution_website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_schools');
    }
};
