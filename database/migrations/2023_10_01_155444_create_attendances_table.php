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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')->references('id')
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
            // who take attendance for student
            $table->foreignId('teacher_id')
                ->constrained('teachers')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->date('for_day');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
