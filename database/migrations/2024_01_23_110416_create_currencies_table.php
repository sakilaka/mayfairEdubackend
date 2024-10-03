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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('currency_name')->nullable();
            $table->string('currency_icon')->nullable();
            $table->string('currency_position')->nullable();
            $table->string('thousands_separator')->nullable();
            $table->string('decimal_separator')->nullable();
            $table->string('decimal_digit')->nullable();
            $table->float('exchange_rate')->nullable();
            $table->string('is_default')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
