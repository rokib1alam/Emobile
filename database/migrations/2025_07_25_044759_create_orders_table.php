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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10)->default('BDT');
            $table->string('transaction_id')->unique();
            $table->string('status')->default('pending'); // order status
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending'); // paid, failed, cancelled
            $table->text('ipn_response')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
