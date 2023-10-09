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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('joining_date');
            $table->text('address');

            $table->foreignId('gender_id')
                ->constrained('genders')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('specialization_id')
                ->constrained('specializations')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();



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
