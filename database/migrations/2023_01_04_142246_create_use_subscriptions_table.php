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
        Schema::create('use_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();


            $table->string('name',255)->nullable();
            $table->text('email')->nullable();
            $table->text('address')->nullable();
            $table->string('mobile',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('zipcode',255)->nullable();

            $table->float('sub_total')->nullable();
            $table->float('total_amount')->nullable();
            $table->float('coupon')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('use_subscriptions');
    }
};
