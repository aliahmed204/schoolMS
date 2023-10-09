<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * fund accounts  For Accountent
     */
    public function up(): void
    {
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');

            $table->foreignId('receipt_id')->nullable()
                ->constrained('receipt_students')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('payment_id')->nullable()
                ->constrained('payment_students')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->decimal('debit',10,2)->nullable();
            $table->decimal('credit',10,2)->nullable();
            $table->string('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_accounts');
    }
};
