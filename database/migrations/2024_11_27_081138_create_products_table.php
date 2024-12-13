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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_short_description');
            $table->string('product_image');
            $table->string('product_price');
            $table->string('product_category');
            $table->string('product_quantity');
            $table->string('discounted_price')->nullable();
            $table->string('product_status');
            $table->text('product_description');
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropForeign(['admin_id']);
        $table->dropColumn('admin_id');
    });
}
};
