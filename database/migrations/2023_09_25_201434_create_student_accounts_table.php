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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');

            $table->foreignId('student_id')
                ->constrained('students')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            // الايرادات الفلوس اللى الطالب هيدفعها
            $table->foreignId('fee_invoices_id')->nullable()
                ->constrained('fee_invoices')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

                            //  سندات القبض الطالب دفع كام من اللى عليه
            $table->foreignId('receipt_id')->nullable()
                ->constrained('receipt_students')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('payment_id')->nullable()
                ->constrained('payment_students')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

                    // سند قيض - معاجلة الرسوم فى حالة الطالب هيسيب المدرسة
            $table->foreignId('processing_fees_id')->nullable()
                ->constrained('processing_fees')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->decimal('debit','10','2')->nullable();
            $table->decimal('credit','10','2')->nullable();
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
