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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();    // প্রকল্পের বিস্তারিত
            $table->text('challenge')->nullable();      // প্রকল্পের চ্যালেঞ্জ
            $table->json('features')->nullable();       // প্রকল্পের বৈশিষ্ট্যসমূহ
            $table->json('images')->nullable();         // প্রকল্পের ছবি
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('set null'); // ক্লায়েন্ট যিনি রিভিউ দিয়েছেন
            $table->string('architect')->nullable();
            $table->string('location')->nullable();
            $table->string('size')->nullable();         // e.g. "100000 SF"
            $table->string('status')->nullable();       // e.g. "Completed"
            $table->string('year_completed')->nullable();
            $table->string('category')->nullable();     // e.g. "Commercial"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
