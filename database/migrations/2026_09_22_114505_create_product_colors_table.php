<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->string('color');

            // Main image for this color
            $table->string('thumbnail')->nullable();

            // Other images for this color
            $table->json('images')->nullable();

            $table->timestamps();

            // Same product cannot have duplicate color
            $table->unique(['product_id', 'color']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_colors');
    }
};
