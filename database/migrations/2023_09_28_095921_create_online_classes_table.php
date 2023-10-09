<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * $table->boolean('integration');
     * $table->foreignId('user_id')->->constrained('users')references('id')->on('users')->onDelete('cascade');
     */
    public function up(): void
    {
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_id')
                ->constrained('grades')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('class_id')
                ->constrained('class_rooms')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('section_id')
                ->constrained('sections')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('created_by')->nullable();
            $table->string('meeting_id');
            $table->string('topic');
            $table->dateTime('start_at');
            $table->integer('duration')->comment('minutes');
            $table->string('password')->comment('meeting password');
            $table->text('start_url');
            $table->text('join_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_classes');
    }
};
