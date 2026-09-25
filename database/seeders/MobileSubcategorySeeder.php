<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;

class MobileSubcategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            'Mobile Phone' => [
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
            ],

            'Mobile Accessories' => [
                'Mobile Cover',
                'Screen Protector',
                'Charging Accessories',
                'Mobile Holder',
                'Camera Protector',
            ],

            'Smart Watch' => [
                'Apple Watch',
                'Samsung Watch',
                'Xiaomi Watch',
                'Huawei Watch',
                'Amazfit',
                'Haylou',
            ],

            'Earbuds' => [
                'Apple AirPods',
                'Samsung Galaxy Buds',
                'Xiaomi Earbuds',
                'Redmi Earbuds',
                'Realme Earbuds',
                'JBL Earbuds',
            ],

            'Neckband' => [
                'Xiaomi Neckband',
                'Realme Neckband',
                'OnePlus Neckband',
                'Oppo Neckband',
                'JBL Neckband',
            ],

            'Power Bank' => [
                'Xiaomi Power Bank',
                'Remax Power Bank',
                'Baseus Power Bank',
                'Hoco Power Bank',
                'Anker Power Bank',
            ],

            'Button Phone' => [
                'Nokia',
                'Symphony',
                'Itel',
                'Walton',
                'Lava',
            ],

            'Router' => [
                'TP-Link',
                'Tenda',
                'D-Link',
                'Huawei',
                'ZTE',
            ],

            'Trimmer' => [
                'Philips',
                'Xiaomi',
                'Kemei',
                'VGR',
                'Hoco',
            ],
        ];


        foreach ($data as $categoryName => $subcategories) {

            $category = Category::where(
                'category_name',
                $categoryName
            )->first();

            if (!$category) {
                $this->command->warn(
                    "Category not found: {$categoryName}"
                );

                continue;
            }

            foreach ($subcategories as $subcategoryName) {

                Subcategory::updateOrCreate(
                    [
                        'category_id' => $category->id,
                        'subcategory_name' => $subcategoryName,
                    ],
                    [
                        'subcategory_slug' => Str::slug(
                            $subcategoryName,
                            '-'
                        ),
                    ]
                );
            }
        }

        $this->command->info(
            'All subcategories added successfully!'
        );
    }
}

