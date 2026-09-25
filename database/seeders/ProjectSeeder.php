<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'title' => 'Green Building Project',
                'description' => 'This is a green building project with sustainable materials and eco-friendly features.',
                'challenge' => 'Designing a fully sustainable building with limited resources.',
                'features' => json_encode(['Solar Panels', 'Rainwater Harvesting', 'LED Lighting']),
                'images' => json_encode(['img/project-1.jpg', 'img/project-2.jpg']),
                'client_id' => 1,  // Assuming client with ID 1 exists
                'architect' => 'ABC Architects',
                'location' => 'New York, USA',
                'size' => '50,000 SF',
                'status' => 'Completed',
                'year_completed' => '2022',
                'category' => 'Commercial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tech Office Building',
                'description' => 'A modern office building designed for a tech company.',
                'challenge' => 'Designing a workspace that fosters creativity and innovation.',
                'features' => json_encode(['Open Plan', 'Smart Office Systems', 'Flexible Layouts']),
                'images' => json_encode(['img/project-3.jpg', 'img/project-4.jpg']),
                'client_id' => 2,  // Assuming client with ID 2 exists
                'architect' => 'XYZ Designers',
                'location' => 'San Francisco, USA',
                'size' => '120,000 SF',
                'status' => 'In Progress',
                'year_completed' => null,  // Not yet completed
                'category' => 'Commercial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Luxury Apartment Complex',
                'description' => 'A luxury apartment complex with high-end amenities.',
                'challenge' => 'Building a modern living space with eco-friendly materials.',
                'features' => json_encode(['Swimming Pool', 'Gym', 'Eco-friendly Appliances']),
                'images' => json_encode(['img/project-5.jpg', 'img/project-6.jpg']),
                'client_id' => 3,  // Assuming client with ID 3 exists
                'architect' => 'LMN Architects',
                'location' => 'Los Angeles, USA',
                'size' => '200,000 SF',
                'status' => 'Completed',
                'year_completed' => '2023',
                'category' => 'Residential',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
