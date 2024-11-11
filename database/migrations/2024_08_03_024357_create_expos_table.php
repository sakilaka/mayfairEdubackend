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
        Schema::create('expos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('banner')->nullable();
            $table->string('date');
            $table->text('place');
            $table->text('universities')->nullable();
            $table->text('guests')->nullable();
            $table->text('media_partner')->nullable();
            $table->longText('photos')->nullable();
            $table->longText('videos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expos');
    }
};
