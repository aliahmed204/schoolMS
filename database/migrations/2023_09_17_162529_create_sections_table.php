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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status' , [0,1]); // show Or Disable
            $table->foreignId('grade_id')
                ->constrained('grades')
                ->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('class_id')
                ->constrained('class_rooms')
                ->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
