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
        Schema::create('maestro_class_setups', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title')->nullable();
            $table->string('title2')->nullable();
            $table->string('title3')->nullable();
            $table->text('banner_image')->nullable();
            $table->text('banner_video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maestro_class_setups');
    }
};
