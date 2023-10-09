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
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('date_of_birth');
            $table->string('academic_year');

            $table->foreignId('gender_id')
                ->constrained('genders')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('nationality_id')
                ->constrained('nationalities')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('blood_id')
                 ->constrained('blood_types')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('grade_id')
                ->constrained('grades')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('class_id')
                ->constrained('class_rooms')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('section_id')
                ->constrained('sections')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('parent_id')
                ->constrained('student_parents')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->softDeletes();
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
