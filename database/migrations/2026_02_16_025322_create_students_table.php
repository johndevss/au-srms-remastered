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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('campus');
            $table->string('program');
            $table->string('admit_type');
            $table->string('year_level');
            $table->string('school_year');
            $table->string('term');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('gender');
            $table->string('civil_status');
            $table->string('citizenship');
            $table->date('date_of_birth');
            $table->string('birthplace');
            $table->string('religion');
            $table->string('current_street_no');
            $table->string('current_street');
            $table->string('current_subdivision')->nullable();
            $table->string('current_barangay');
            $table->string('current_city');
            $table->string('current_province')->nullable();
            $table->string('current_zip_code')->nullable();
            $table->string('permanent_street_no');
            $table->string('permanent_street');
            $table->string('permanent_subdivision')->nullable();
            $table->string('permanent_barangay');
            $table->string('permanent_city');
            $table->string('permanent_province')->nullable();
            $table->string('permanent_zip_code')->nullable();
            $table->string('telephone_no')->nullable();
            $table->string('mobile_no');
            $table->string('email')->unique();
            $table->string('last_school_type');
            $table->string('last_school_name');
            $table->string('last_school_program')->nullable();
            $table->date('last_school_date_of_graduation')->nullable();
            $table->string('last_school_year');
            $table->string('last_school_year_level');
            $table->string('last_school_term')->nullable();
            $table->string('father_first_name')->nullable();
            $table->string('father_last_name')->nullable();
            $table->string('father_middle_initial')->nullable();
            $table->string('father_suffix')->nullable();
            $table->string('father_mobile_no')->nullable();
            $table->string('father_email')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_first_name')->nullable();
            $table->string('mother_last_name')->nullable();
            $table->string('mother_middle_initial')->nullable();
            $table->string('mother_suffix')->nullable();
            $table->string('mother_mobile_no')->nullable();
            $table->string('mother_email')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('guardian_first_name')->nullable();
            $table->string('guardian_last_name')->nullable();
            $table->string('guardian_middle_initial')->nullable();
            $table->string('guardian_suffix')->nullable();
            $table->string('guardian_mobile_no')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
