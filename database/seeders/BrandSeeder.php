<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [

            // =========================
            // Mobile Phone
            // =========================
            'Samsung',
            'Redmi',
            'Realme',
            'Oppo',
            'Vivo',
            'Honor',
            'Infinix',
            'Tecno',
            'Itel',
            'ZTE Nubia',
            'Villaon',

            // =========================
            // Mobile Accessories
            // =========================
            'Apple',
            'Baseus',
            'Hoco',
            'Remax',
            'Joyroom',
            'UGREEN',

            // =========================
            // Smart Watch
            // =========================
            'Xiaomi',
            'Huawei',
            'Amazfit',
            'Haylou',
            'Oraimo',

            // =========================
            // Earbuds
            // =========================
            'JBL',
            'QCY',
            'OnePlus',

            // =========================
            // Power Bank
            // =========================
            'Anker',

            // =========================
            // Button Phone
            // =========================
            'Nokia',
            'Symphony',
            'Walton',
            'Lava',

            // =========================
            // Router
            // =========================
            'TP-Link',
            'Tenda',
            'D-Link',

            // =========================
            // Trimmer
            // =========================
            'Philips',
            'Kemei',
            'VGR',
        ];


        foreach ($brands as $brandName) {

            Brand::updateOrCreate(
                [
                    'brand_name' => $brandName,
                ],
                [
                    'brand_slug' => Str::slug($brandName, '-'),
                    'front_page' => 1,
                    'brand_logo' => '',
                ]
            );
        }


        $this->command->info(
            count($brands) . ' brands seeded successfully.'
        );
    }
}

