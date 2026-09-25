<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;

class MobileChildcategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            /*
            |--------------------------------------------------------------------------
            | MOBILE PHONE
            |--------------------------------------------------------------------------
            */

            'Mobile Phone' => [

                'Samsung' => [
                    'Galaxy A07 (4/64)',
                    'Galaxy A17 (6/128)',
                    'Galaxy A17 (8/256)',
                ],

                'Redmi' => [
                    'A7 (3/64)',
                    'A7 pro (4/64)',
                    'Redmi 17 (4/128)',
                    'Redmi 17 (6/128)',
                    'Redmi Note 17 (6/128)',
                    'Redmi Note 17 (8/256)',
                    'Redmi Note 17 Pro 5G (8/256)',
                    'Redmi Note 17 Pro Max (8/256)',
                    'Redmi 17T (12/256)',
                ],

                'Realme' => [
                    'C100i (4/64)',
                    'C100i (4/128)',
                    'C100x (4/128)',
                    'C100x (6/128)',
                    'C85 Pro (8/128)',
                    'Realme 14 5G (12/256)',
                ],

                'Oppo' => [
                    'A6x (4/64)',
                    'A6c (4/64)',
                    'A6k (6/128)',
                    'A6 (6/128)',
                    'A6 (8/128)',
                ],

                'Vivo' => [
                    'Y05e (4/64)',
                    'Y05 (4/64)',
                    'YO5 (4/128)',
                    'Y21D (6/128)',
                    'Y31D (6/128)',
                    'Y31D (8/256)',
                    'Y500 (6/128)',
                    'V80 Lite',
                ],

                'Honor' => [
                    'X6C (6/128)',
                    'X6d (4/128)',
                    'x7d (8/128)',
                    'X7D (8/256)',
                    'X8d',
                    'X9D (12/256)',
                    '600 Lite',
                ],

                'Infinix' => [
                    'Smart 20 (4/64)',
                    'Smart 20 (4/128)',
                    'Hot 70 (4/128)',
                    'Hot 70 (6/128)',
                    'Hot 70 (8/128)',
                    'Hot 70 Pro',
                    'Note Edge (8/128)',
                    'Note Edge (8/256)',
                    'Note 60 Pro',
                ],

                'Tecno' => [
                    'Go 3 (4/64)',
                    'Go 3 (4/128)',
                    'Spark 50 (4/128)',
                    'Spark 50 (6/128)',
                    'Spark 50c (4/64)',
                    'Spark 50c (4/128)',
                    'Spark 50 Pro',
                    'Camon 50 (8/128)',
                    'Camon 50 (8/256)',
                    'Camon Air (8/128)',
                    'Camon Air (8/256)',
                    'Pova Curve 2 (8/128)',
                    'Pova Curve 2 (8/256)',
                ],

                'Itel' => [
                    'A100c (2/64)',
                    'A100c (4/64)',
                    'A200+ (4/64)',
                    'City 200 (6/128)',
                ],

                'ZTE Nubia' => [
                    'A36 (4/64)',
                    'A35e (2/64)',
                    'V80 Design (8/128)',
                ],

                'Villaon' => [
                    'V50S (3/64)',
                    'V50S (4/64)',
                    'Hyper 100 (6/128)',
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | MOBILE ACCESSORIES
            |--------------------------------------------------------------------------
            */

            'Mobile Accessories' => [

                'Mobile Cover' => [
                    'iPhone Cover',
                    'Samsung Cover',
                    'Redmi Cover',
                    'Realme Cover',
                ],

                'Screen Protector' => [
                    'Tempered Glass',
                    'Privacy Glass',
                    'Full Glue Glass',
                    'Hydrogel Protector',
                ],

                'Charging Accessories' => [
                    'Type-C Cable',
                    'Lightning Cable',
                    'Micro USB Cable',
                    'Fast Charger',
                ],

                'Mobile Holder' => [
                    'Bike Holder',
                    'Car Holder',
                    'Desk Holder',
                    'Magnetic Holder',
                ],

                'Camera Protector' => [
                    'iPhone Camera Protector',
                    'Samsung Camera Protector',
                    'Redmi Camera Protector',
                    'Universal Camera Protector',
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | SMART WATCH
            |--------------------------------------------------------------------------
            */

            'Smart Watch' => [

                'Apple Watch' => [
                    'Apple Watch Series',
                    'Apple Watch SE',
                    'Apple Watch Ultra',
                ],

                'Samsung Watch' => [
                    'Galaxy Watch',
                    'Galaxy Watch Active',
                    'Galaxy Watch Classic',
                ],

                'Xiaomi Watch' => [
                    'Xiaomi Watch S Series',
                    'Xiaomi Redmi Watch',
                    'Xiaomi Watch 2',
                ],

                'Huawei Watch' => [
                    'Huawei Watch GT',
                    'Huawei Watch Fit',
                    'Huawei Watch Ultimate',
                ],

                'Amazfit' => [
                    'Amazfit Bip',
                    'Amazfit GTR',
                    'Amazfit GTS',
                ],

                'Haylou' => [
                    'Haylou RS Series',
                    'Haylou Solar Series',
                    'Haylou Watch',
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | EARBUDS
            |--------------------------------------------------------------------------
            */

            'Earbuds' => [

                'Apple AirPods' => [
                    'AirPods 2',
                    'AirPods 3',
                    'AirPods Pro',
                ],

                'Samsung Galaxy Buds' => [
                    'Galaxy Buds FE',
                    'Galaxy Buds 2',
                    'Galaxy Buds Pro',
                ],

                'Xiaomi Earbuds' => [
                    'Xiaomi Buds',
                    'Xiaomi Buds Pro',
                    'Xiaomi Redmi Buds',
                ],

                'Redmi Earbuds' => [
                    'Redmi Buds 4',
                    'Redmi Buds 5',
                    'Redmi Buds Pro',
                ],

                'Realme Earbuds' => [
                    'Realme Buds Air',
                    'Realme Buds Air Pro',
                    'Realme Buds T Series',
                ],

                'JBL Earbuds' => [
                    'JBL Wave',
                    'JBL Tune',
                    'JBL Live',
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | NECKBAND
            |--------------------------------------------------------------------------
            */

            'Neckband' => [

                'Xiaomi Neckband' => [
                    'Mi Neckband',
                    'Mi Neckband Pro',
                    'Xiaomi Bluetooth Neckband',
                ],

                'Realme Neckband' => [
                    'Realme Buds Wireless',
                    'Realme Buds Wireless 2',
                    'Realme Buds Wireless Pro',
                ],

                'OnePlus Neckband' => [
                    'OnePlus Bullets Wireless',
                    'OnePlus Bullets Wireless Z',
                    'OnePlus Bullets Wireless Z2',
                ],

                'Oppo Neckband' => [
                    'Oppo Enco M31',
                    'Oppo Enco M32',
                    'Oppo Wireless Neckband',
                ],

                'JBL Neckband' => [
                    'JBL Tune Neckband',
                    'JBL Live Neckband',
                    'JBL Bluetooth Neckband',
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | POWER BANK
            |--------------------------------------------------------------------------
            */

            'Power Bank' => [

                'Xiaomi Power Bank' => [
                    'Xiaomi 10000mAh',
                    'Xiaomi 20000mAh',
                    'Xiaomi Fast Charging Power Bank',
                ],

                'Remax Power Bank' => [
                    'Remax 10000mAh',
                    'Remax 20000mAh',
                    'Remax Fast Charging Power Bank',
                ],

                'Baseus Power Bank' => [
                    'Baseus 10000mAh',
                    'Baseus 20000mAh',
                    'Baseus Fast Charging Power Bank',
                ],

                'Hoco Power Bank' => [
                    'Hoco 10000mAh',
                    'Hoco 20000mAh',
                    'Hoco Mini Power Bank',
                ],

                'Anker Power Bank' => [
                    'Anker 10000mAh',
                    'Anker 20000mAh',
                    'Anker PowerCore',
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | BUTTON PHONE
            |--------------------------------------------------------------------------
            */

            'Button Phone' => [

                'Nokia' => [
                    'Nokia Basic Phone',
                    'Nokia Feature Phone',
                    'Nokia Dual SIM Phone',
                ],

                'Symphony' => [
                    'Symphony Basic Phone',
                    'Symphony Feature Phone',
                    'Symphony Dual SIM Phone',
                ],

                'Itel' => [
                    'Itel Basic Phone',
                    'Itel Feature Phone',
                    'Itel Power Phone',
                ],

                'Walton' => [
                    'Walton Basic Phone',
                    'Walton Feature Phone',
                    'Walton Dual SIM Phone',
                ],

                'Lava' => [
                    'Lava Basic Phone',
                    'Lava Feature Phone',
                    'Lava Dual SIM Phone',
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | ROUTER
            |--------------------------------------------------------------------------
            */

            'Router' => [

                'TP-Link' => [
                    'TP-Link WiFi Router',
                    'TP-Link 4G Router',
                    'TP-Link Dual Band Router',
                ],

                'Tenda' => [
                    'Tenda WiFi Router',
                    'Tenda 4G Router',
                    'Tenda Dual Band Router',
                ],

                'D-Link' => [
                    'D-Link WiFi Router',
                    'D-Link 4G Router',
                    'D-Link Dual Band Router',
                ],

                'Huawei' => [
                    'Huawei WiFi Router',
                    'Huawei 4G Router',
                    'Huawei 5G Router',
                ],

                'ZTE' => [
                    'ZTE WiFi Router',
                    'ZTE 4G Router',
                    'ZTE 5G Router',
                ],
            ],


            /*
            |--------------------------------------------------------------------------
            | TRIMMER
            |--------------------------------------------------------------------------
            */

            'Trimmer' => [

                'Philips' => [
                    'Philips Beard Trimmer',
                    'Philips Hair Trimmer',
                    'Philips Multigroom',
                ],

                'Xiaomi' => [
                    'Xiaomi Beard Trimmer',
                    'Xiaomi Hair Trimmer',
                    'Xiaomi Grooming Kit',
                ],

                'Kemei' => [
                    'Kemei Beard Trimmer',
                    'Kemei Hair Trimmer',
                    'Kemei Professional Trimmer',
                ],

                'VGR' => [
                    'VGR Beard Trimmer',
                    'VGR Hair Clipper',
                    'VGR Professional Trimmer',
                ],

                'Hoco' => [
                    'Hoco Beard Trimmer',
                    'Hoco Hair Trimmer',
                    'Hoco Grooming Kit',
                ],
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | INSERT CHILD CATEGORIES
        |--------------------------------------------------------------------------
        */

        foreach ($data as $categoryName => $subcategories) {

            /*
            |--------------------------------------------------------------------------
            | Find Main Category
            |--------------------------------------------------------------------------
            */

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


            /*
            |--------------------------------------------------------------------------
            | Loop Subcategories
            |--------------------------------------------------------------------------
            */

            foreach ($subcategories as $subcategoryName => $children) {

                $subcategory = Subcategory::where(
                    'category_id',
                    $category->id
                )
                ->where(
                    'subcategory_name',
                    $subcategoryName
                )
                ->first();


                /*
                |--------------------------------------------------------------------------
                | Subcategory Not Found
                |--------------------------------------------------------------------------
                */

                if (!$subcategory) {

                    $this->command->warn(
                        "Subcategory not found: {$categoryName} → {$subcategoryName}"
                    );

                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Loop Child Categories
                |--------------------------------------------------------------------------
                */

                foreach ($children as $childName) {

                    Childcategory::updateOrCreate(

                        [
                            'category_id' => $category->id,
                            'subcategory_id' => $subcategory->id,
                            'childcategory_name' => $childName,
                        ],

                        [
                            'childcategory_slug' => Str::slug(
                                $childName,
                                '-'
                            ),
                        ]

                    );
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            'All childcategories added successfully!'
        );
    }
}
