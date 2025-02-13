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
        Schema::create('application_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->string('application_id')->unique();
            $table->string('transaction_type');
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('category');
            $table->decimal('amount', 10, 2);
            $table->boolean('is_refundable')->default(false);
            $table->decimal('refundable_amount', 10, 2)->default(0);
            $table->string('status');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_transactions');
    }
};
