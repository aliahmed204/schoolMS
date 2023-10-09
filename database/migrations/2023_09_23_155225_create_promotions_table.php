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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('from_grade')
                ->constrained('grades')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('from_class')
                ->constrained('class_rooms')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('from_section')
                ->constrained('sections')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('to_grade')
                ->constrained('grades')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('to_class')
                ->constrained('class_rooms')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('to_section')
                ->constrained('sections')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('from_academic_year');
            $table->string('to_academic_year');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
