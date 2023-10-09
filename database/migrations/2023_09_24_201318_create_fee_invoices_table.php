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
        Schema::create('fee_invoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');

            $table->foreignId('student_id')
                ->constrained('students')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('grade_id')
                ->constrained('grades')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('class_id')
                ->constrained('class_rooms')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('fee_id')
                ->constrained('fees')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->decimal('amount','10','2');
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_invoices');
    }
};
