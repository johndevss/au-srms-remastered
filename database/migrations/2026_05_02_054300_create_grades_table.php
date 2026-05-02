<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->decimal('quarter_1', 5, 2)->nullable();
            $table->decimal('quarter_2', 5, 2)->nullable();
            $table->decimal('quarter_3', 5, 2)->nullable();
            $table->decimal('quarter_4', 5, 2)->nullable();
            $table->decimal('final_grade', 5, 2)->nullable();
            $table->unique(['student_id', 'section_id', 'teacher_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};