<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    public function run()
    {
        DB::table('clients')->insert([
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'phone' => '1234567890',
                'company' => 'Solar Power Ltd',
                'rating' => 5,
                'review_text' => 'Excellent service and project management!',
                'password' => bcrypt('12345678'), // পাসওয়ার্ড হ্যাশ করা হচ্ছে
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'phone' => '9876543210',
                'company' => 'Tech Innovators',
                'rating' => 4,
                'review_text' => 'Great experience, would definitely recommend.',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michaelb@example.com',
                'phone' => '5551234567',
                'company' => 'Green Solutions',
                'rating' => 3,
                'review_text' => 'Good work, but there were some delays in delivery.',
                'password' => bcrypt('12345678'),
            ],
        ]);
    }
}

