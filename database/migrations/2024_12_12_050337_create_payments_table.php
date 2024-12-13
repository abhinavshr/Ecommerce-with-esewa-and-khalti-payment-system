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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company_name')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('street_address');
            $table->string('postcode')->nullable();
            $table->string('cart_product_name');
            $table->string('cart_product_quantity');
            $table->text('order_notes')->nullable();
            $table->integer('total');
            $table->string('esewa_stauts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
