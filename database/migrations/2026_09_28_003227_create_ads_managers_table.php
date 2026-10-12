<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ads_managers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('discount_text')->nullable();
            $table->string('image');
            $table->string('link')->nullable();
            $table->tinyInteger('banner_position')->default(1); // 1 = Top, 2 = Bottom
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ads_managers');
    }
};