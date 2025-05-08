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
        Schema::create('xml_feeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shop_profiles')->onDelete('cascade');
            $table->string('url');
            $table->dateTime('last_processed')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('error_message')->nullable();
            $table->integer('products_count')->default(0);
            $table->integer('success_count')->default(0);
            $table->integer('error_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xml_feeds');
    }
};
