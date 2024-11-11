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
        Schema::create('instructor_page_setups', function (Blueprint $table) {
            $table->id();
            $table->string('top_title')->nullable();
            $table->longText('description1')->nullable();
            $table->string('button1')->nullable();
            $table->string('image1')->nullable();

            $table->longText('text1')->nullable();
            $table->longText('text2')->nullable();

            $table->longText('text3')->nullable();

            $table->longText('ptext1')->nullable();
            $table->longText('ptext2')->nullable();
            $table->longText('ptext3')->nullable();
            $table->longText('ptext4')->nullable();

            $table->longText('text4')->nullable();
            $table->longText('email')->nullable();
            $table->string('button2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_page_setups');
    }
};
