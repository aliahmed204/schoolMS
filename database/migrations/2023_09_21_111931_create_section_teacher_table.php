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
        Schema::create('section_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')
                ->constrained('sections')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('teacher_id')
                ->constrained('teachers')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_teacher');
    }
};
