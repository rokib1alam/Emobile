<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | MOBILE PHONE PRODUCTS
        |--------------------------------------------------------------------------
        | Mobile Phone:
        | Category -> Subcategory -> Product
        |
        | childcategory_id = NULL
        |--------------------------------------------------------------------------
        */

        $mobileProducts = [

            'Samsung' => [
                [
                    'name' => 'Samsung Galaxy A07 4GB/64GB',
                    'price' => 14999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Samsung Galaxy A17 6GB/128GB',
                    'price' => 21999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Samsung Galaxy A17 8GB/256GB',
                    'price' => 25999,
                    'color' => 'Blue'
                ],
            ],

            'Redmi' => [
                [
                    'name' => 'Xiaomi Redmi A7 3GB/64GB',
                    'price' => 13999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Redmi A7 Pro 4GB/64GB',
                    'price' => 14999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Xiaomi Redmi 17 4GB/128GB',
                    'price' => 16999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Redmi 17 6GB/128GB',
                    'price' => 18999,
                    'color' => 'Green'
                ],
                [
                    'name' => 'Xiaomi Redmi Note 17 6GB/128GB',
                    'price' => 21999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Redmi Note 17 8GB/256GB',
                    'price' => 24999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Xiaomi Redmi Note 17 Pro 5G 8GB/256GB',
                    'price' => 29999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Redmi Note 17 Pro Max 8GB/256GB',
                    'price' => 34999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Xiaomi Redmi 17T 12GB/256GB',
                    'price' => 32999,
                    'color' => 'Black'
                ],
            ],

            'Realme' => [
                [
                    'name' => 'Realme C100i 4GB/64GB',
                    'price' => 17999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Realme C100i 4GB/128GB',
                    'price' => 20999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Realme C100x 4GB/128GB',
                    'price' => 18999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Realme C100x 6GB/128GB',
                    'price' => 20999,
                    'color' => 'Green'
                ],
                [
                    'name' => 'Realme C85 Pro 8GB/128GB',
                    'price' => 24999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Realme 14 5G 12GB/256GB',
                    'price' => 34999,
                    'color' => 'Purple'
                ],
            ],

            'Oppo' => [
                [
                    'name' => 'Oppo A6x 4GB/64GB',
                    'price' => 16999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Oppo A6c 4GB/64GB',
                    'price' => 19999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Oppo A6k 6GB/128GB',
                    'price' => 21999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Oppo A6 6GB/128GB',
                    'price' => 24999,
                    'color' => 'Green'
                ],
                [
                    'name' => 'Oppo A6 8GB/128GB',
                    'price' => 27999,
                    'color' => 'Black'
                ],
            ],

            'Vivo' => [
                [
                    'name' => 'Vivo Y05e 4GB/64GB',
                    'price' => 14999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Vivo Y05 4GB/64GB',
                    'price' => 15999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Vivo Y05 4GB/128GB',
                    'price' => 17999,
                    'color' => 'Green'
                ],
                [
                    'name' => 'Vivo Y21D 6GB/128GB',
                    'price' => 20999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Vivo Y31D 6GB/128GB',
                    'price' => 23999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Vivo Y31D 8GB/256GB',
                    'price' => 27999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Vivo Y500 6GB/128GB',
                    'price' => 25999,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Vivo V80 Lite',
                    'price' => 29999,
                    'color' => 'Black'
                ],
            ],

            'Honor' => [
                [
                    'name' => 'Honor X6C 6GB/128GB',
                    'price' => 17999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Honor X6d 4GB/128GB',
                    'price' => 18999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Honor X7d 8GB/128GB',
                    'price' => 22999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Honor X7D 8GB/256GB',
                    'price' => 25999,
                    'color' => 'Green'
                ],
                [
                    'name' => 'Honor X8d',
                    'price' => 29999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Honor X9D 12GB/256GB',
                    'price' => 39999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Honor 600 Lite',
                    'price' => 44999,
                    'color' => 'Black'
                ],
            ],

            'Infinix' => [
                [
                    'name' => 'Infinix Smart 20 4GB/64GB',
                    'price' => 11999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Infinix Smart 20 4GB/128GB',
                    'price' => 12999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Infinix Hot 70 4GB/128GB',
                    'price' => 20999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Infinix Hot 70 6GB/128GB',
                    'price' => 24999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Infinix Hot 70 8GB/128GB',
                    'price' => 25999,
                    'color' => 'Green'
                ],
                [
                    'name' => 'Infinix Hot 70 Pro',
                    'price' => 28999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Infinix Note Edge 8GB/128GB',
                    'price' => 29999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Infinix Note Edge 8GB/256GB',
                    'price' => 32999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Infinix Note 60 Pro',
                    'price' => 35999,
                    'color' => 'Black'
                ],
            ],

            'Tecno' => [
                [
                    'name' => 'Tecno Go 3 4GB/64GB',
                    'price' => 11999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Tecno Go 3 4GB/128GB',
                    'price' => 13999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Tecno Spark 50 4GB/128GB',
                    'price' => 15999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Tecno Spark 50 6GB/128GB',
                    'price' => 17999,
                    'color' => 'Green'
                ],
                [
                    'name' => 'Tecno Spark 50C 4GB/64GB',
                    'price' => 12999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Tecno Spark 50C 4GB/128GB',
                    'price' => 14999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Tecno Spark 50 Pro',
                    'price' => 19999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Tecno Camon 50 8GB/128GB',
                    'price' => 24999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Tecno Camon 50 8GB/256GB',
                    'price' => 27999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Tecno Camon Air 8GB/128GB',
                    'price' => 25999,
                    'color' => 'Green'
                ],
                [
                    'name' => 'Tecno Camon Air 8GB/256GB',
                    'price' => 28999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Tecno Pova Curve 2 8GB/128GB',
                    'price' => 29999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Tecno Pova Curve 2 8GB/256GB',
                    'price' => 32999,
                    'color' => 'Blue'
                ],
            ],

            'Itel' => [
                [
                    'name' => 'Itel A100C 2GB/64GB',
                    'price' => 8999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Itel A100C 4GB/64GB',
                    'price' => 9999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Itel A200+ 4GB/64GB',
                    'price' => 10999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Itel City 200 6GB/128GB',
                    'price' => 13999,
                    'color' => 'Green'
                ],
            ],

            'ZTE Nubia' => [
                [
                    'name' => 'ZTE Nubia A36 4GB/64GB',
                    'price' => 11999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'ZTE Nubia A35e 2GB/64GB',
                    'price' => 9999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'ZTE Nubia V80 Design 8GB/128GB',
                    'price' => 22999,
                    'color' => 'Black'
                ],
            ],

            'Villaon' => [
                [
                    'name' => 'Villaon V50S 3GB/64GB',
                    'price' => 8999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Villaon V50S 4GB/64GB',
                    'price' => 9999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Villaon Hyper 100 6GB/128GB',
                    'price' => 13999,
                    'color' => 'Black'
                ],
            ],
        ];
        /*
        |--------------------------------------------------------------------------
        | MOBILE ACCESSORIES
        |--------------------------------------------------------------------------
        */

        $mobileAccessories = [

            'Mobile Cover' => [

                [
                    'name' => 'iPhone 15 Pro Silicone MagSafe Cover',
                    'price' => 599,
                    'color' => 'Black'
                ],
                [
                    'name' => 'iPhone 15 Pro Silicone MagSafe Cover',
                    'price' => 599,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Samsung Galaxy S24 Ultra Premium Cover',
                    'price' => 499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Samsung Galaxy S24 Ultra Premium Cover',
                    'price' => 499,
                    'color' => 'Transparent'
                ],
                [
                    'name' => 'Redmi Note 14 Pro Silicone Cover',
                    'price' => 399,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Redmi Note 14 Pro Silicone Cover',
                    'price' => 399,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Realme 14 5G Premium Silicone Cover',
                    'price' => 399,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Realme 14 5G Premium Silicone Cover',
                    'price' => 399,
                    'color' => 'Green'
                ],

            ],

            'Screen Protector' => [

                [
                    'name' => '9D Tempered Glass Screen Protector',
                    'price' => 199,
                    'color' => 'Clear'
                ],
                [
                    'name' => '9D Tempered Glass Screen Protector',
                    'price' => 199,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Privacy Glass Screen Protector',
                    'price' => 299,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Privacy Glass Screen Protector',
                    'price' => 299,
                    'color' => 'Clear'
                ],
                [
                    'name' => 'Full Glue 5D Glass Protector',
                    'price' => 249,
                    'color' => 'Clear'
                ],
                [
                    'name' => 'Full Glue 5D Glass Protector',
                    'price' => 249,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Hydrogel Flexible Screen Protector',
                    'price' => 349,
                    'color' => 'Clear'
                ],
                [
                    'name' => 'Hydrogel Flexible Screen Protector',
                    'price' => 349,
                    'color' => 'Matte'
                ],

            ],

            'Charging Accessories' => [

                [
                    'name' => 'Braided Type-C Fast Charging Cable 1M',
                    'price' => 299,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Braided Type-C Fast Charging Cable 1M',
                    'price' => 299,
                    'color' => 'White'
                ],
                [
                    'name' => 'Lightning Fast Charging Cable 1M',
                    'price' => 349,
                    'color' => 'White'
                ],
                [
                    'name' => 'Lightning Fast Charging Cable 1M',
                    'price' => 349,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Micro USB Data Charging Cable 1M',
                    'price' => 199,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Micro USB Data Charging Cable 1M',
                    'price' => 199,
                    'color' => 'White'
                ],
                [
                    'name' => '25W Fast Charger USB Type-C',
                    'price' => 799,
                    'color' => 'White'
                ],
                [
                    'name' => '25W Fast Charger USB Type-C',
                    'price' => 799,
                    'color' => 'Black'
                ],

            ],

            'Mobile Holder' => [

                [
                    'name' => '360° Bike Mobile Holder',
                    'price' => 699,
                    'color' => 'Black'
                ],
                [
                    'name' => '360° Bike Mobile Holder',
                    'price' => 699,
                    'color' => 'Red'
                ],
                [
                    'name' => 'Car Dashboard Mobile Holder',
                    'price' => 599,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Car Dashboard Mobile Holder',
                    'price' => 599,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Adjustable Desk Mobile Holder',
                    'price' => 399,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Adjustable Desk Mobile Holder',
                    'price' => 399,
                    'color' => 'White'
                ],
                [
                    'name' => 'Magnetic Car Mobile Holder',
                    'price' => 499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Magnetic Car Mobile Holder',
                    'price' => 499,
                    'color' => 'Silver'
                ],

            ],

            'Camera Protector' => [

                [
                    'name' => 'iPhone Camera Lens Protector',
                    'price' => 249,
                    'color' => 'Clear'
                ],
                [
                    'name' => 'iPhone Camera Lens Protector',
                    'price' => 249,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Samsung Camera Lens Protector',
                    'price' => 249,
                    'color' => 'Clear'
                ],
                [
                    'name' => 'Samsung Camera Lens Protector',
                    'price' => 249,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Redmi Camera Lens Protector',
                    'price' => 199,
                    'color' => 'Clear'
                ],
                [
                    'name' => 'Redmi Camera Lens Protector',
                    'price' => 199,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Universal Camera Lens Protector',
                    'price' => 149,
                    'color' => 'Clear'
                ],
                [
                    'name' => 'Universal Camera Lens Protector',
                    'price' => 149,
                    'color' => 'Black'
                ],

            ],
        ];
        /*
        |--------------------------------------------------------------------------
        | SMART WATCH
        |--------------------------------------------------------------------------
        */

        $smartWatch = [

            'Apple Watch' => [

                [
                    'name' => 'Apple Watch Series 10 GPS',
                    'price' => 49999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Apple Watch Series 10 GPS',
                    'price' => 49999,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Apple Watch SE 2nd Gen',
                    'price' => 29999,
                    'color' => 'Midnight'
                ],
                [
                    'name' => 'Apple Watch SE 2nd Gen',
                    'price' => 29999,
                    'color' => 'Starlight'
                ],
                [
                    'name' => 'Apple Watch Ultra 2',
                    'price' => 89999,
                    'color' => 'Titanium'
                ],

            ],

            'Samsung Watch' => [

                [
                    'name' => 'Samsung Galaxy Watch 7',
                    'price' => 34999,
                    'color' => 'Green'
                ],
                [
                    'name' => 'Samsung Galaxy Watch 7',
                    'price' => 34999,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Samsung Galaxy Watch Active 2',
                    'price' => 21999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Samsung Galaxy Watch Active 2',
                    'price' => 21999,
                    'color' => 'Pink'
                ],
                [
                    'name' => 'Samsung Galaxy Watch 6 Classic',
                    'price' => 37999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Samsung Galaxy Watch 6 Classic',
                    'price' => 37999,
                    'color' => 'Silver'
                ],

            ],

            'Xiaomi Watch' => [

                [
                    'name' => 'Xiaomi Watch S4',
                    'price' => 16999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Watch S4',
                    'price' => 16999,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Xiaomi Redmi Watch 5',
                    'price' => 8999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Redmi Watch 5',
                    'price' => 8999,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Xiaomi Watch 2',
                    'price' => 19999,
                    'color' => 'Black'
                ],

            ],

            'Huawei Watch' => [

                [
                    'name' => 'Huawei Watch GT 5',
                    'price' => 24999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Huawei Watch GT 5',
                    'price' => 24999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Huawei Watch Fit 3',
                    'price' => 16999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Huawei Watch Fit 3',
                    'price' => 16999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Huawei Watch Ultimate',
                    'price' => 99999,
                    'color' => 'Black'
                ],

            ],

            'Amazfit' => [

                [
                    'name' => 'Amazfit Bip 5',
                    'price' => 8999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Amazfit Bip 5',
                    'price' => 8999,
                    'color' => 'Pink'
                ],
                [
                    'name' => 'Amazfit GTR 4',
                    'price' => 18999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Amazfit GTR 4',
                    'price' => 18999,
                    'color' => 'Brown'
                ],
                [
                    'name' => 'Amazfit GTS 4',
                    'price' => 16999,
                    'color' => 'Black'
                ],

            ],

            'Haylou' => [

                [
                    'name' => 'Haylou RS4 Plus',
                    'price' => 5999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Haylou RS4 Plus',
                    'price' => 5999,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Haylou Solar Plus',
                    'price' => 5499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Haylou Solar Plus',
                    'price' => 5499,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Haylou Watch R8',
                    'price' => 4999,
                    'color' => 'Black'
                ],

            ],
        ];
        /*
        |--------------------------------------------------------------------------
        | EARBUDS
        |--------------------------------------------------------------------------
        */

        $earbuds = [

            'Apple AirPods' => [

                [
                    'name' => 'Apple AirPods 2nd Generation',
                    'price' => 16999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Apple AirPods 3rd Generation',
                    'price' => 21999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Apple AirPods Pro 2nd Generation',
                    'price' => 29999,
                    'color' => 'White'
                ],

            ],

            'Samsung Galaxy Buds' => [

                [
                    'name' => 'Samsung Galaxy Buds FE',
                    'price' => 7999,
                    'color' => 'Graphite'
                ],
                [
                    'name' => 'Samsung Galaxy Buds FE',
                    'price' => 7999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Samsung Galaxy Buds 2',
                    'price' => 10999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Samsung Galaxy Buds 2',
                    'price' => 10999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Samsung Galaxy Buds Pro',
                    'price' => 14999,
                    'color' => 'Black'
                ],

            ],

            'Xiaomi Earbuds' => [

                [
                    'name' => 'Xiaomi Buds 5',
                    'price' => 7999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Buds 5',
                    'price' => 7999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Xiaomi Buds 5 Pro',
                    'price' => 12999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Redmi Buds 6',
                    'price' => 4499,
                    'color' => 'White'
                ],

            ],

            'Redmi Earbuds' => [

                [
                    'name' => 'Redmi Buds 4',
                    'price' => 3499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Redmi Buds 4',
                    'price' => 3499,
                    'color' => 'White'
                ],
                [
                    'name' => 'Redmi Buds 5',
                    'price' => 3999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Redmi Buds 5',
                    'price' => 3999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Redmi Buds Pro',
                    'price' => 4999,
                    'color' => 'Black'
                ],

            ],

            'Realme Earbuds' => [

                [
                    'name' => 'Realme Buds Air 6',
                    'price' => 6999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Realme Buds Air 6',
                    'price' => 6999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Realme Buds Air Pro',
                    'price' => 5999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Realme Buds T300',
                    'price' => 4999,
                    'color' => 'Black'
                ],

            ],

            'JBL Earbuds' => [

                [
                    'name' => 'JBL Wave Buds',
                    'price' => 4999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'JBL Wave Buds',
                    'price' => 4999,
                    'color' => 'White'
                ],
                [
                    'name' => 'JBL Tune Buds',
                    'price' => 5999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'JBL Live Pro 2',
                    'price' => 12999,
                    'color' => 'Black'
                ],

            ],
        ];
        /*
        |--------------------------------------------------------------------------
        | NECKBAND
        |--------------------------------------------------------------------------
        */

        $neckband = [

            'Xiaomi Neckband' => [

                [
                    'name' => 'Mi Bluetooth Neckband',
                    'price' => 1999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Mi Bluetooth Neckband Pro',
                    'price' => 2499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Bluetooth Neckband Pro',
                    'price' => 2999,
                    'color' => 'Black'
                ],

            ],

            'Realme Neckband' => [

                [
                    'name' => 'Realme Buds Wireless 2',
                    'price' => 2999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Realme Buds Wireless 2',
                    'price' => 2999,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Realme Buds Wireless 2 Neo',
                    'price' => 1999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Realme Buds Wireless Pro',
                    'price' => 3999,
                    'color' => 'Black'
                ],

            ],

            'OnePlus Neckband' => [

                [
                    'name' => 'OnePlus Bullets Wireless Z',
                    'price' => 2499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'OnePlus Bullets Wireless Z',
                    'price' => 2499,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'OnePlus Bullets Wireless Z2',
                    'price' => 2999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'OnePlus Bullets Wireless Z2',
                    'price' => 2999,
                    'color' => 'Green'
                ],

            ],

            'Oppo Neckband' => [

                [
                    'name' => 'Oppo Enco M31',
                    'price' => 2999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Oppo Enco M32',
                    'price' => 2499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Oppo Wireless Neckband',
                    'price' => 1999,
                    'color' => 'Black'
                ],

            ],

            'JBL Neckband' => [

                [
                    'name' => 'JBL Tune 215BT Neckband',
                    'price' => 3499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'JBL Tune 215BT Neckband',
                    'price' => 3499,
                    'color' => 'White'
                ],
                [
                    'name' => 'JBL Live Neckband',
                    'price' => 4999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'JBL Bluetooth Neckband',
                    'price' => 2999,
                    'color' => 'Blue'
                ],

            ],
        ];
        /*
        |--------------------------------------------------------------------------
        | POWER BANK
        |--------------------------------------------------------------------------
        */

        $powerBank = [

            'Xiaomi Power Bank' => [

                [
                    'name' => 'Xiaomi Power Bank 10000mAh',
                    'price' => 2499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Power Bank 10000mAh',
                    'price' => 2499,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Xiaomi Power Bank 20000mAh',
                    'price' => 3999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi 33W Fast Charging Power Bank',
                    'price' => 4499,
                    'color' => 'Black'
                ],

            ],

            'Remax Power Bank' => [

                [
                    'name' => 'Remax Power Bank 10000mAh',
                    'price' => 1999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Remax Power Bank 10000mAh',
                    'price' => 1999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Remax Power Bank 20000mAh',
                    'price' => 2999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Remax Fast Charging Power Bank 22.5W',
                    'price' => 3499,
                    'color' => 'Black'
                ],

            ],

            'Baseus Power Bank' => [

                [
                    'name' => 'Baseus Power Bank 10000mAh',
                    'price' => 2999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Baseus Power Bank 10000mAh',
                    'price' => 2999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Baseus Power Bank 20000mAh',
                    'price' => 4499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Baseus Fast Charging Power Bank 65W',
                    'price' => 6999,
                    'color' => 'Black'
                ],

            ],

            'Hoco Power Bank' => [

                [
                    'name' => 'Hoco Power Bank 10000mAh',
                    'price' => 1499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Hoco Power Bank 10000mAh',
                    'price' => 1499,
                    'color' => 'White'
                ],
                [
                    'name' => 'Hoco Power Bank 20000mAh',
                    'price' => 2499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Hoco Mini Power Bank 5000mAh',
                    'price' => 999,
                    'color' => 'Black'
                ],

            ],

            'Anker Power Bank' => [

                [
                    'name' => 'Anker Power Bank 10000mAh',
                    'price' => 4999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Anker Power Bank 20000mAh',
                    'price' => 6999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Anker PowerCore 10000mAh',
                    'price' => 5499,
                    'color' => 'Black'
                ],

            ],
        ];
        /*
        |--------------------------------------------------------------------------
        | BUTTON PHONE
        |--------------------------------------------------------------------------
        */

        $buttonPhone = [

            'Nokia' => [

                [
                    'name' => 'Nokia 105 Classic',
                    'price' => 2499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Nokia 105 Classic',
                    'price' => 2499,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Nokia 110 4G',
                    'price' => 3499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Nokia 110 4G',
                    'price' => 3499,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Nokia 225 4G',
                    'price' => 4999,
                    'color' => 'Black'
                ],

            ],

            'Symphony' => [

                [
                    'name' => 'Symphony L25',
                    'price' => 1899,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Symphony L25',
                    'price' => 1899,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Symphony B12',
                    'price' => 1699,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Symphony Dual SIM Feature Phone',
                    'price' => 1999,
                    'color' => 'Black'
                ],

            ],

            'Itel' => [

                [
                    'name' => 'Itel it2166',
                    'price' => 1599,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Itel it2173',
                    'price' => 1699,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Itel Power 110',
                    'price' => 2299,
                    'color' => 'Black'
                ],

            ],

            'Walton' => [

                [
                    'name' => 'Walton Olvio L28',
                    'price' => 1799,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Walton Olvio L28',
                    'price' => 1799,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Walton Feature Phone',
                    'price' => 1999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Walton Dual SIM Phone',
                    'price' => 2199,
                    'color' => 'Black'
                ],

            ],

            'Lava' => [

                [
                    'name' => 'Lava A1',
                    'price' => 1899,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Lava A1',
                    'price' => 1899,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Lava Hero 600',
                    'price' => 2299,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Lava Dual SIM Feature Phone',
                    'price' => 1999,
                    'color' => 'Black'
                ],

            ],
        ];
        /*
        |--------------------------------------------------------------------------
        | ROUTER
        |--------------------------------------------------------------------------
        */

        $router = [

            'TP-Link' => [

                [
                    'name' => 'TP-Link TL-WR840N WiFi Router',
                    'price' => 1599,
                    'color' => 'White'
                ],
                [
                    'name' => 'TP-Link TL-MR6400 4G Router',
                    'price' => 7999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'TP-Link Archer C6 Dual Band Router',
                    'price' => 4499,
                    'color' => 'Black'
                ],

            ],

            'Tenda' => [

                [
                    'name' => 'Tenda N301 WiFi Router',
                    'price' => 1399,
                    'color' => 'White'
                ],
                [
                    'name' => 'Tenda 4G03 4G LTE Router',
                    'price' => 4999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Tenda AC10 Dual Band Router',
                    'price' => 2999,
                    'color' => 'Black'
                ],

            ],

            'D-Link' => [

                [
                    'name' => 'D-Link DIR-615 WiFi Router',
                    'price' => 1699,
                    'color' => 'Black'
                ],
                [
                    'name' => 'D-Link DWR-M920 4G Router',
                    'price' => 6999,
                    'color' => 'White'
                ],
                [
                    'name' => 'D-Link DIR-825 Dual Band Router',
                    'price' => 3999,
                    'color' => 'Black'
                ],

            ],

            'Huawei' => [

                [
                    'name' => 'Huawei B315 4G WiFi Router',
                    'price' => 6999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Huawei B535 4G Router',
                    'price' => 9999,
                    'color' => 'White'
                ],
                [
                    'name' => 'Huawei 5G CPE Pro Router',
                    'price' => 24999,
                    'color' => 'White'
                ],

            ],

            'ZTE' => [

                [
                    'name' => 'ZTE MF286C 4G Router',
                    'price' => 6999,
                    'color' => 'White'
                ],
                [
                    'name' => 'ZTE MC801A 5G Router',
                    'price' => 22999,
                    'color' => 'White'
                ],
                [
                    'name' => 'ZTE Dual Band WiFi Router',
                    'price' => 2999,
                    'color' => 'Black'
                ],

            ],
        ];
        /*
        |--------------------------------------------------------------------------
        | TRIMMER
        |--------------------------------------------------------------------------
        */

        $trimmer = [

            'Philips' => [

                [
                    'name' => 'Philips Beard Trimmer BT1234',
                    'price' => 2499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Philips Beard Trimmer BT1234',
                    'price' => 2499,
                    'color' => 'Blue'
                ],
                [
                    'name' => 'Philips Hair Trimmer HC3505',
                    'price' => 2999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Philips Multigroom Series 5000',
                    'price' => 4999,
                    'color' => 'Black'
                ],

            ],

            'Xiaomi' => [

                [
                    'name' => 'Xiaomi Beard Trimmer 2',
                    'price' => 2499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Beard Trimmer 2',
                    'price' => 2499,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Xiaomi Hair Clipper',
                    'price' => 2999,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Xiaomi Grooming Kit Pro',
                    'price' => 3999,
                    'color' => 'Black'
                ],

            ],

            'Kemei' => [

                [
                    'name' => 'Kemei KM-5021 Beard Trimmer',
                    'price' => 1299,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Kemei KM-5021 Beard Trimmer',
                    'price' => 1299,
                    'color' => 'Gold'
                ],
                [
                    'name' => 'Kemei Hair Trimmer KM-809',
                    'price' => 1499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Kemei Professional Trimmer KM-1949',
                    'price' => 1799,
                    'color' => 'Black'
                ],

            ],

            'VGR' => [

                [
                    'name' => 'VGR V-071 Beard Trimmer',
                    'price' => 1599,
                    'color' => 'Black'
                ],
                [
                    'name' => 'VGR V-071 Beard Trimmer',
                    'price' => 1599,
                    'color' => 'Gold'
                ],
                [
                    'name' => 'VGR V-030 Hair Clipper',
                    'price' => 1899,
                    'color' => 'Black'
                ],
                [
                    'name' => 'VGR Professional Trimmer V-937',
                    'price' => 2299,
                    'color' => 'Black'
                ],

            ],

            'Hoco' => [

                [
                    'name' => 'Hoco Y3 Beard Trimmer',
                    'price' => 1299,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Hoco Y3 Beard Trimmer',
                    'price' => 1299,
                    'color' => 'Silver'
                ],
                [
                    'name' => 'Hoco Hair Trimmer Y6',
                    'price' => 1499,
                    'color' => 'Black'
                ],
                [
                    'name' => 'Hoco Grooming Kit',
                    'price' => 1999,
                    'color' => 'Black'
                ],

            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | CREATE MOBILE PHONE PRODUCTS
        |--------------------------------------------------------------------------
        */

        $mobileCategory = Category::where(
            'category_name',
            'Mobile Phone'
        )->first();

        if ($mobileCategory) {

            foreach ($mobileProducts as $subcategoryName => $products) {

                $subcategory = Subcategory::where(
                    'category_id',
                    $mobileCategory->id
                )
                ->where(
                    'subcategory_name',
                    $subcategoryName
                )
                ->first();

                if (!$subcategory) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | FIND BRAND
                |--------------------------------------------------------------------------
                */

                $brand = Brand::where(
                    'brand_name',
                    $subcategoryName
                )->first();


                foreach ($products as $index => $productData) {

                    $productName = $productData['name'];

                    Product::updateOrCreate(
                        [
                            'category_id' => $mobileCategory->id,
                            'subcategory_id' => $subcategory->id,
                            'childcategory_id' => null,
                            'product_name' => $productName,
                        ],
                        [
                            'product_slug' => Str::slug(
                                $subcategoryName . '-' . $productName
                            ),

                            'product_code' =>
                                'MOB-' .
                                strtoupper(
                                    Str::slug($subcategoryName)
                                ) .
                                '-' .
                                str_pad(
                                    $index + 1,
                                    3,
                                    '0',
                                    STR_PAD_LEFT
                                ),

                            /*
                            |--------------------------------------------------------------------------
                            | BRAND ID
                            |--------------------------------------------------------------------------
                            */
                            'brand_id' => $brand?->id,

                            'pickup_point_id' => null,

                            'unit' => 'Piece',

                            'tags' => strtolower(
                                $subcategoryName .
                                ',' .
                                $productName
                            ),

                            'material' => 'N/A',

                            'color' => $productData['color'],

                            'size' => Str::contains(
                                $productName,
                                '/'
                            )
                                ? trim(
                                    Str::afterLast(
                                        $productName,
                                        ' '
                                    )
                                )
                                : null,

                            'video' => null,

                            'purchase_price' => round(
                                $productData['price'] * 0.90
                            ),

                            'selling_price' =>
                                $productData['price'],

                            'discount_price' => null,

                            'stock_quantity' => 20,

                            'warehouse' => 'Main Warehouse',

                            'description' =>
                                $productName .
                                ' is available at RymosBD. ' .
                                'Product details and specifications ' .
                                'will be updated with actual product information.',

                            /*
                            |--------------------------------------------------------------------------
                            | IMAGE
                            |--------------------------------------------------------------------------
                            | পরে manually image add করবে.
                            |--------------------------------------------------------------------------
                            */

                            'thumbnail' => null,
                            'images' => null,

                            'featured' => 0,
                            'today_deal' => 0,

                            'status' => 1,

                            'admin_id' => null,

                            'date' => date('d-m-y'),
                            'month' => date('F'),
                        ]
                    );
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | OTHER CATEGORIES
        |--------------------------------------------------------------------------
        |
        | Existing Childcategories will automatically become Products.
        |
        |--------------------------------------------------------------------------
        */

        $excludedCategories = [
            'Mobile Phone',
        ];


        $childcategories = Childcategory::with([
            'category',
            'subcategory'
        ])->get();


        foreach ($childcategories as $childcategory) {

            /*
            |--------------------------------------------------------------------------
            | SKIP MOBILE PHONE CHILD CATEGORIES
            |--------------------------------------------------------------------------
            */

            if (
                $childcategory->category &&
                in_array(
                    $childcategory->category->category_name,
                    $excludedCategories
                )
            ) {
                continue;
            }


            if (
                !$childcategory->category ||
                !$childcategory->subcategory
            ) {
                continue;
            }


            $categoryName =
                $childcategory->category->category_name;

            $subcategoryName =
                $childcategory->subcategory->subcategory_name;

            $productName =
                $childcategory->childcategory_name;


            /*
            |--------------------------------------------------------------------------
            | FIND BRAND
            |--------------------------------------------------------------------------
            |
            | Example:
            |
            | Apple AirPods
            |       ↓
            | Apple
            |
            | Samsung Watch
            |       ↓
            | Samsung
            |
            |--------------------------------------------------------------------------
            */

            $brandName = $this->getBrandName(
                $categoryName,
                $subcategoryName,
                $productName
            );


            $brand = Brand::where(
                'brand_name',
                $brandName
            )->first();


            /*
            |--------------------------------------------------------------------------
            | PRICE
            |--------------------------------------------------------------------------
            */

            $sellingPrice = $this->getDefaultPrice(
                $categoryName,
                $subcategoryName,
                $productName
            );


            /*
            |--------------------------------------------------------------------------
            | PRODUCT CODE
            |--------------------------------------------------------------------------
            */

            $productCode =
                'PRD-' .
                strtoupper(
                    Str::substr(
                        Str::slug($categoryName),
                        0,
                        4
                    )
                ) .
                '-' .
                $childcategory->id;


            Product::updateOrCreate(
                [
                    'category_id' =>
                        $childcategory->category_id,

                    'subcategory_id' =>
                        $childcategory->subcategory_id,

                    'childcategory_id' =>
                        $childcategory->id,

                    'product_name' =>
                        $productName,
                ],
                [
                    'product_slug' =>
                        Str::slug(
                            $subcategoryName .
                            '-' .
                            $productName
                        ),

                    'product_code' =>
                        $productCode,

                    /*
                    |--------------------------------------------------------------------------
                    | BRAND ID
                    |--------------------------------------------------------------------------
                    */

                    'brand_id' => $brand?->id,

                    'pickup_point_id' => null,

                    'unit' => 'Piece',

                    'tags' => strtolower(
                        $categoryName .
                        ',' .
                        $subcategoryName .
                        ',' .
                        $productName
                    ),

                    'material' => 'N/A',

                    'color' => null,

                    'size' => null,

                    'video' => null,

                    'purchase_price' =>
                        round($sellingPrice * 0.85),

                    'selling_price' =>
                        $sellingPrice,

                    'discount_price' => null,

                    'stock_quantity' => 25,

                    'warehouse' => 'Main Warehouse',

                    'description' =>
                        $productName .
                        ' from ' .
                        $subcategoryName .
                        '. Product specifications and images ' .
                        'will be updated later.',

                    'thumbnail' => null,

                    'images' => null,

                    'featured' => 0,

                    'today_deal' => 0,

                    'status' => 1,

                    'admin_id' => null,

                    'date' => date('d-m-y'),

                    'month' => date('F'),
                ]
            );
        }


        $this->command->info(
            'Product seeding completed successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GET BRAND NAME
    |--------------------------------------------------------------------------
    */

    private function getBrandName(
        string $category,
        string $subcategory,
        string $product
    ): string {

        /*
        |--------------------------------------------------------------------------
        | Direct Brand Mapping
        |--------------------------------------------------------------------------
        */

        $brandMap = [

            // Mobile Accessories
            'Mobile Cover' => null,
            'Screen Protector' => null,
            'Charging Accessories' => null,
            'Mobile Holder' => null,
            'Camera Protector' => null,

            // Smart Watch
            'Apple Watch' => 'Apple',
            'Samsung Watch' => 'Samsung',
            'Xiaomi Watch' => 'Xiaomi',
            'Huawei Watch' => 'Huawei',
            'Amazfit' => 'Amazfit',
            'Haylou' => 'Haylou',

            // Earbuds
            'Apple AirPods' => 'Apple',
            'Samsung Galaxy Buds' => 'Samsung',
            'Xiaomi Earbuds' => 'Xiaomi',
            'Redmi Earbuds' => 'Redmi',
            'Realme Earbuds' => 'Realme',
            'JBL Earbuds' => 'JBL',

            // Neckband
            'Xiaomi Neckband' => 'Xiaomi',
            'Realme Neckband' => 'Realme',
            'OnePlus Neckband' => 'OnePlus',
            'Oppo Neckband' => 'Oppo',
            'JBL Neckband' => 'JBL',

            // Power Bank
            'Xiaomi Power Bank' => 'Xiaomi',
            'Remax Power Bank' => 'Remax',
            'Baseus Power Bank' => 'Baseus',
            'Hoco Power Bank' => 'Hoco',
            'Anker Power Bank' => 'Anker',

            // Button Phone
            'Nokia' => 'Nokia',
            'Symphony' => 'Symphony',
            'Itel' => 'Itel',
            'Walton' => 'Walton',
            'Lava' => 'Lava',

            // Router
            'TP-Link' => 'TP-Link',
            'Tenda' => 'Tenda',
            'D-Link' => 'D-Link',
            'Huawei' => 'Huawei',
            'ZTE' => 'ZTE Nubia',

            // Trimmer
            'Philips' => 'Philips',
            'Xiaomi' => 'Xiaomi',
            'Kemei' => 'Kemei',
            'VGR' => 'VGR',
            'Hoco' => 'Hoco',
        ];


        /*
        |--------------------------------------------------------------------------
        | First Try Subcategory Mapping
        |--------------------------------------------------------------------------
        */

        if (array_key_exists($subcategory, $brandMap)) {

            if ($brandMap[$subcategory] !== null) {
                return $brandMap[$subcategory];
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Mobile Accessories
        |--------------------------------------------------------------------------
        |
        | Product name দেখে Brand নির্ধারণ
        |
        |--------------------------------------------------------------------------
        */

        $productLower = strtolower($product);


        if (str_contains($productLower, 'iphone')) {
            return 'Apple';
        }

        if (str_contains($productLower, 'samsung')) {
            return 'Samsung';
        }

        if (str_contains($productLower, 'redmi')) {
            return 'Redmi';
        }

        if (str_contains($productLower, 'realme')) {
            return 'Realme';
        }

        /*
        |--------------------------------------------------------------------------
        | Generic accessories
        |--------------------------------------------------------------------------
        |
        | Brand নির্দিষ্ট না হলে null return করবে.
        |--------------------------------------------------------------------------
        */

        return '';
    }


    /*
    |--------------------------------------------------------------------------
    | DEFAULT PRICE
    |--------------------------------------------------------------------------
    */

    private function getDefaultPrice(
        string $category,
        string $subcategory,
        string $product
    ): int {

        $category = strtolower($category);
        $subcategory = strtolower($subcategory);
        $product = strtolower($product);


        /*
        |--------------------------------------------------------------------------
        | Mobile Accessories
        |--------------------------------------------------------------------------
        */

        if (str_contains($category, 'accessor')) {

            if (str_contains($product, 'tempered')) {
                return 299;
            }

            if (str_contains($product, 'privacy')) {
                return 499;
            }

            if (str_contains($product, 'hydrogel')) {
                return 399;
            }

            if (str_contains($product, 'glass')) {
                return 349;
            }

            if (str_contains($product, 'cable')) {
                return 299;
            }

            if (str_contains($product, 'fast charger')) {
                return 899;
            }

            if (str_contains($product, 'holder')) {
                return 699;
            }

            if (str_contains($product, 'camera protector')) {
                return 249;
            }

            if (str_contains($product, 'cover')) {
                return 499;
            }

            return 599;
        }


        /*
        |--------------------------------------------------------------------------
        | Smart Watch
        |--------------------------------------------------------------------------
        */

        if (str_contains($category, 'smart watch')) {

            if (str_contains($product, 'ultra')) {
                return 3999;
            }

            if (str_contains($product, 'series')) {
                return 2499;
            }

            if (str_contains($product, 'active')) {
                return 2999;
            }

            if (str_contains($product, 'classic')) {
                return 4999;
            }

            if (str_contains($product, 'fit')) {
                return 2999;
            }

            if (str_contains($product, 'gt')) {
                return 4999;
            }

            if (str_contains($product, 'bip')) {
                return 2499;
            }

            if (str_contains($product, 'gtr')) {
                return 4999;
            }

            if (str_contains($product, 'gts')) {
                return 3999;
            }

            return 1999;
        }


        /*
        |--------------------------------------------------------------------------
        | Earbuds
        |--------------------------------------------------------------------------
        */

        if (str_contains($category, 'earbuds')) {

            if (str_contains($product, 'pro')) {
                return 2999;
            }

            if (str_contains($product, 'live')) {
                return 2499;
            }

            if (str_contains($product, 'tune')) {
                return 1999;
            }

            return 1499;
        }


        /*
        |--------------------------------------------------------------------------
        | Neckband
        |--------------------------------------------------------------------------
        */

        if (str_contains($category, 'neckband')) {

            if (str_contains($product, 'pro')) {
                return 1999;
            }

            if (str_contains($product, 'wireless pro')) {
                return 2999;
            }

            if (str_contains($product, 'wireless z2')) {
                return 2499;
            }

            return 1499;
        }


        /*
        |--------------------------------------------------------------------------
        | Power Bank
        |--------------------------------------------------------------------------
        */

        if (str_contains($category, 'power bank')) {

            if (str_contains($product, '20000')) {
                return 2299;
            }

            if (str_contains($product, 'fast charging')) {
                return 2699;
            }

            if (str_contains($product, 'powercore')) {
                return 2999;
            }

            if (str_contains($product, 'mini')) {
                return 999;
            }

            return 1499;
        }


        /*
        |--------------------------------------------------------------------------
        | Button Phone
        |--------------------------------------------------------------------------
        */

        if (str_contains($category, 'button phone')) {

            if (str_contains($product, 'power phone')) {
                return 2499;
            }

            if (str_contains($product, 'dual sim')) {
                return 1999;
            }

            if (str_contains($product, 'feature phone')) {
                return 1999;
            }

            return 1699;
        }


        /*
        |--------------------------------------------------------------------------
        | Router
        |--------------------------------------------------------------------------
        */

        if (str_contains($category, 'router')) {

            if (str_contains($product, '5g')) {
                return 4999;
            }

            if (str_contains($product, '4g')) {
                return 2999;
            }

            if (str_contains($product, 'dual band')) {
                return 1999;
            }

            return 1499;
        }


        /*
        |--------------------------------------------------------------------------
        | Trimmer
        |--------------------------------------------------------------------------
        */

        if (str_contains($category, 'trimmer')) {

            if (str_contains($product, 'professional')) {
                return 2499;
            }

            if (str_contains($product, 'multigroom')) {
                return 2999;
            }

            if (str_contains($product, 'grooming kit')) {
                return 1999;
            }

            if (str_contains($product, 'hair clipper')) {
                return 1799;
            }

            return 1499;
        }


        /*
        |--------------------------------------------------------------------------
        | FALLBACK
        |--------------------------------------------------------------------------
        */

        return 999;
    }
}
