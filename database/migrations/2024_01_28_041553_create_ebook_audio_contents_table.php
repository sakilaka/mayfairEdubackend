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
        Schema::create('ebook_audio_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ebook_id')->nullable();
            $table->string('audio_name')->nullable();
            $table->text('audio_file')->nullable();
            $table->tinyInteger('is_free')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebook_audio_contents');
    }
};
