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
        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Father information
            $table->string('Father_Name');
            $table->string('Father_National_ID');
            $table->string('Father_Passport_ID');
            $table->string('Father_Phone');
            $table->string('Father_job');
            $table->string('Father_Address');

            $table->foreignId('Father_Nationality')
                ->constrained('nationalities')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('Father_Blood_Type')
                ->constrained('blood_types')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('Father_Religion')
                ->constrained('religions')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            //Mother information
            $table->string('Mother_Name');
            $table->string('Mother_National_ID');
            $table->string('Mother_Passport_ID');
            $table->string('Mother_Phone');
            $table->string('Mother_Job');
            $table->string('Mother_Address');

            $table->foreignId('Mother_Nationality')
                ->constrained('nationalities')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('Mother_Blood_Type')
                ->constrained('blood_types')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('Mother_Religion')
                ->constrained('religions')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_parents');
    }
};
