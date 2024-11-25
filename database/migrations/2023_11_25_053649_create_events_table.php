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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->string('name')->nullable();

            $table->string('startdate')->nullable();
            $table->string('enddate')->nullable();
            $table->integer('speaker')->nullable();
            $table->integer('session')->nullable();
            $table->integer('day')->nullable();
            $table->float('fee')->nullable();

            $table->longText('about')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
