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
        Schema::create('page_controls', function (Blueprint $table) {
            $table->id();
            $table->string('page');
            $table->text('url')->nullable();
            $table->enum('section', ['quick_links', 'explore', 'policies']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_controls');
    }
};
