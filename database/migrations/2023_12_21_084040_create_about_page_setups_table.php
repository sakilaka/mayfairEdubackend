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
        Schema::create('about_page_setups', function (Blueprint $table) {
            $table->id();
            $table->string('about_text')->nullable(); 
            $table->string('description1')->nullable();
            $table->string('video_thumbnail')->nullable();
            $table->string('video_url')->nullable();
            $table->string('about_text2')->nullable();               
            $table->string('description2')->nullable();
            $table->string('about_text3')->nullable();
            $table->string('description3')->nullable();
            $table->string('about_text4')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_page_setups');
    }
};
