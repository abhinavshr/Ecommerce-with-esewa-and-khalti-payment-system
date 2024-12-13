<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
            $table->text('order_notes')->nullable();
            $table->float('total');
            $table->string('payment_status')->default('pending');
            $table->text('cart_product_name');
            $table->text('cart_product_quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
