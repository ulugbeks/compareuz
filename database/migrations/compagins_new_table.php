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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shop_profiles')->onDelete('cascade');
            $table->string('name');
            $table->string('type'); // 'banner' or 'elements'
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('status')->default('pending'); // pending, active, rejected, completed
            $table->string('banner_image')->nullable();
            $table->string('target_url')->nullable();
            $table->decimal('budget', 10, 2)->default(0);
            $table->decimal('cost_per_click', 10, 5)->default(0);
            $table->integer('impressions')->default(0);
            $table->integer('clicks')->default(0);
            $table->text('admin_notes')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};