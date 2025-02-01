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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->string('client_name')->nullable();
            $table->string('client_phone')->nullable();
            $table->enum('transaction_type', ['IN', 'OUT', 'DEPOSIT']);
            $table->text('category')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('is_refundable');
            $table->decimal('refundable_amount', 15, 2)->default(0)->nullable();
            $table->decimal('refunded_amount', 15, 2)->default(0)->nullable();
            $table->text('description')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();$table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};