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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Employment Info
            $table->string('campus');
            $table->string('department');
            $table->string('position');
            $table->string('employment_type');
            $table->string('employment_status');
            $table->date('date_hired');

            // Personal Info
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

            // Address
            $table->string('street_no')->nullable();
            $table->string('street');
            $table->string('subdivision')->nullable();
            $table->string('barangay');
            $table->string('city');
            $table->string('province')->nullable();
            $table->string('zip_code')->nullable();

            // Contact
            $table->string('telephone_no')->nullable();
            $table->string('mobile_no');
            $table->string('email')->unique();

            // Educational Background
            $table->string('highest_educational_attainment');
            $table->string('degree');
            $table->string('school')->nullable();
            $table->string('year_graduated')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
