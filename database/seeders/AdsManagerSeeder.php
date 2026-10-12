<?php

namespace Database\Seeders;

use App\Models\AdsManager;
use App\Models\Category;
use Illuminate\Database\Seeder;

class AdsManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ১. আপনার বিদ্যমান ক্যাটাগরিগুলো ফেচ করা
        $mobileCategory      = Category::where('category_slug', 'mobile-phone')->first();
        $accessoriesCategory = Category::where('category_slug', 'mobile-accessories')->first();
        $smartWatchCategory  = Category::where('category_slug', 'smart-watch')->first();
        $earbudsCategory     = Category::where('category_slug', 'earbuds')->first();

        // Mobile Phone-এর জন্য অ্যাডস
        if ($mobileCategory) {
            AdsManager::create([
                'category_id'     => $mobileCategory->id,
                'title'           => 'Latest Smartphone Deals',
                'discount_text'   => '10% Off',
                'image'           => 'frontend/assets/images/menu_banner7.jpg',
                'link'            => route('slug.handler', $mobileCategory->category_slug),
                'banner_position' => 1,
                'status'          => 1,
            ]);

            AdsManager::create([
                'category_id'     => $mobileCategory->id,
                'title'           => 'Flagship Offers',
                'discount_text'   => 'Hot Deal',
                'image'           => 'frontend/assets/images/menu_banner8.jpg',
                'link'            => route('slug.handler', $mobileCategory->category_slug),
                'banner_position' => 2,
                'status'          => 1,
            ]);
        }

        // Mobile Accessories-এর জন্য অ্যাডস
        if ($accessoriesCategory) {
            AdsManager::create([
                'category_id'     => $accessoriesCategory->id,
                'title'           => 'Premium Covers & Glasses',
                'discount_text'   => '20% Off',
                'image'           => 'frontend/assets/images/menu_banner7.jpg',
                'link'            => route('slug.handler', $accessoriesCategory->category_slug),
                'banner_position' => 1,
                'status'          => 1,
            ]);
        }

        // Smart Watch-এর জন্য অ্যাডস
        if ($smartWatchCategory) {
            AdsManager::create([
                'category_id'     => $smartWatchCategory->id,
                'title'           => 'Smart Fitness Watch',
                'discount_text'   => '15% Off',
                'image'           => 'frontend/assets/images/menu_banner8.jpg',
                'link'            => route('slug.handler', $smartWatchCategory->category_slug),
                'banner_position' => 1,
                'status'          => 1,
            ]);
        }

        // Earbuds-এর জন্য অ্যাডস
        if ($earbudsCategory) {
            AdsManager::create([
                'category_id'     => $earbudsCategory->id,
                'title'           => 'TWS Earbuds Collection',
                'discount_text'   => '25% Off',
                'image'           => 'frontend/assets/images/menu_banner7.jpg',
                'link'            => route('slug.handler', $earbudsCategory->category_slug),
                'banner_position' => 1,
                'status'          => 1,
            ]);
        }
    }
}