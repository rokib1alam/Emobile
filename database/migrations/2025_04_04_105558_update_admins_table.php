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
        Schema::table('admins', function (Blueprint $table) {
            $table->string('mobile_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('profession_type')->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('upazila')->nullable();
            $table->string('profile_picture')->nullable(); // Store the filename of the uploaded image
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn([
                'mobile_number',
                'gender',
                'religion',
                'blood_group',
                'profession_type',
                'division',
                'district',
                'upazila',
                'profile_picture',
            ]);
        });
    }
};
