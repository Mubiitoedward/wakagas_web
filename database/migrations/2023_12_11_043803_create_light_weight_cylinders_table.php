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
        Schema::create('light_weight_cylinders', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('capacity');
            $table->integer('stock_quantity');
            $table->integer('refill_price');
            $table->integer('initial_purchase_price');
            $table->string('image_url');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('light_weight_cylinders');
    }
};
