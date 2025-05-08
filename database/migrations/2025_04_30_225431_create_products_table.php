<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('price_sale', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('category_full')->nullable();
            $table->string('category_link')->nullable();
            $table->integer('in_stock')->default(0);
            $table->string('ean')->nullable()->index();
            $table->boolean('used')->default(false);
            $table->decimal('delivery_cost', 10, 2)->nullable();
            $table->integer('delivery_days')->nullable();
            $table->foreignId('shop_id')->constrained('shop_profiles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
