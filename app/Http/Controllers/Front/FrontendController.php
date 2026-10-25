<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\About;
use App\Models\ContactMessage;
use App\Models\Childcategory;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Slider;
use App\Models\review;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $sliders = Slider::all();
        $top_viewed_categories = Category::orderBy('view_count', 'DESC')->limit(6)->get();
        
        foreach ($top_viewed_categories as $category) {
            $category->increment('view_count');
        }

        $brands = Brand::inRandomOrder()->where('front_page', 1)->limit(12)->get();
        $bannerproduct = Product::where('status', 1)->where('product_slider', 1)->latest()->first();

        // Featured Products
        $featured = Product::where('status', 1)->where('featured', 1)->with('colors')->orderBy('id', 'DESC')->limit(16)->get();
        $featured = $this->calculateAndSortRatings($featured); // Assign Return Value

        $today_deal = Product::with(['colors','subcategory'])
            ->where('status', 1)
            ->where('today_deal', 1)
            ->orderBy('id', 'DESC')
            ->first();

        if ($today_deal) {
            $today_deal->countdown_time = Carbon::parse($today_deal->updated_at)->addDays(4)->format('Y/m/d H:i:s');
        }

        // Popular Products
        $popular_product = Product::where('status', 1)->with('colors')->orderBy('product_views', 'DESC')->limit(16)->get();
        $popular_product = $this->calculateAndSortRatings($popular_product); // Assign Return Value

        // Trendy Products
        $trendy_product = Product::where('status', 1)->where('trendy_product', 1)->with('colors')->orderBy('id', 'DESC')->limit(16)->get();
        $trendy_product = $this->calculateAndSortRatings($trendy_product); // Assign Return Value

        $trendy_product_new = Product::where('status', 1)->where('trendy_product', 1)->with(['colors', 'category'])->orderBy('id', 'DESC')->first();

        // Top Rated Products
        $top_rated_products = Product::select('products.*')
            ->with('colors')
            ->leftJoin(DB::raw('(SELECT product_id, MAX(rating) as highest_rating FROM reviews GROUP BY product_id) as reviews'), 'products.id', '=', 'reviews.product_id')
            ->orderBy('reviews.highest_rating', 'DESC')
            ->limit(10)
            ->get();
        $top_rated_products = $this->calculateAndSortRatings($top_rated_products); // Assign Return Value

        $home_category = Category::where('home_page', 1)->with(['subcategories.childCategories', 'ads'])->orderBy('category_name', 'DESC')->get();
        $settings = Setting::all();

        return view('frontend.pages.index', compact(
            'sliders', 'settings', 'top_viewed_categories', 'trendy_product_new', 
            'brands', 'top_rated_products', 'bannerproduct', 'featured', 
            'popular_product', 'trendy_product', 'today_deal', 'home_category'
        ));
    }

    // Updated Helper Function
    private function calculateAndSortRatings($products) {
        foreach ($products as $product) {
            $product->reviewCount = Review::where('product_id', $product->id)->count();
            $product->averageRating = Review::where('product_id', $product->id)->avg('rating') ?? 0;
            $product->highestRating = Review::where('product_id', $product->id)->max('rating') ?? 0;
        }

        // Return the sorted collection
        return $products->sortByDesc('averageRating');
    }

    //Single Page
    public function product_details($slug){
        // Fetch categories with subcategories and child categories
            $categories=Category::with('subcategories.childCategories')->get();
        // Fetch the product details based on the slug
            $product=Product::where('product_slug',$slug)->with('colors')->first();
                     Product::where('product_slug',$slug)->increment('product_views');

                // Decode the JSON-encoded images array
            if ($product) {
                $product->images = json_decode($product->images);
                
                $tags = !empty($product->tags) ? explode(',', $product->tags) : [];
                $color = !empty($product->color) ? explode(',', $product->color) : [];
                $size = !empty($product->size) ? explode(',', $product->size) : [];
        }
        else {
            $tags = [];
            $color = [];
            $size = [];
        }
            // Fetch related products based on the same subcategory
            $releted_product= Product::where('subcategory_id', $product->subcategory_id)->orderBy('id', 'DESC')
            ->take(4)->get() ->each(function ($relatedProduct) {
                $relatedProduct->average_rating = $relatedProduct->reviews()->avg('rating');// related porvuct each rating
                $relatedProduct->review_count = $relatedProduct->reviews()->count();//each  product individual count
            });
            // Fetch reviews for the current product
            $reviews= review::where('product_id', $product->id)->get();
             // Calculate review count and average rating
            $reviewCount = $reviews->count();
            $averageRating = $reviews->avg('rating');
            return view('frontend.product.product_details', compact('product','categories','tags','color','size','releted_product','reviews','averageRating','reviewCount'));

    }
//Product Quick View
    // public function productQuickView($id)
    // {
    //     $product=Product::where('id',$id)->first();
    //     if ($product) {
    //         $product->images = json_decode($product->images);

    //         $tags = !empty($product->tags) ? explode(',', $product->tags) : [];
    //         $color = !empty($product->color) ? explode(',', $product->color) : [];
    //         $size = !empty($product->size) ? explode(',', $product->size) : [];
    //     }
    //     else {
    //         $tags = [];
    //         $color = [];
    //         $size = [];
    //     }
    //     // Fetch reviews for the current product
    //     $reviews= review::where('product_id', $product->id)->get();
    //     // Calculate review count and average rating
    //     $reviewCount = $reviews->count();
    //     $averageRating = $reviews->avg('rating');
    //     return view('frontend.product.quick_view', compact('product','tags','color','size','reviews','averageRating','reviewCount'));
    // }

// Product Quick View
    public function productQuickView($id)
    {
        // colors, brand, category, pickuppoint রিলেশনশিপসহ প্রোডাক্ট লোড করা
        $product = Product::with(['colors', 'brand', 'category', 'pickuppoint'])->find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // JSON Format images চেক এবং ডিকোড করা
        if (!empty($product->images)) {
            $product->images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
        } else {
            $product->images = [];
        }

        // Tags এবং Size প্রসেসিং
        $tags = !empty($product->tags) ? array_map('trim', explode(',', $product->tags)) : [];
        $size = !empty($product->size) ? array_map('trim', explode(',', $product->size)) : [];

        // Fetch reviews for the current product
        $reviews = Review::where('product_id', $product->id)->get();
        
        // Calculate review count and average rating
        $reviewCount = $reviews->count();
        $averageRating = $reviews->avg('rating') ?? 0;

        return view('frontend.product.quick_view', compact(
            'product',
            'tags',
            'size',
            'reviews',
            'averageRating',
            'reviewCount'
        ));
    }

    public function slugHandler($slug)
    {
        // Common values
        $brands = Brand::where('front_page', 1)->get();

        $sizes = Product::whereNotNull('size')->pluck('size')->flatMap(function($item){
            return explode(',', $item);
        })->unique()->values();

        $colors = Product::whereNotNull('color')->pluck('color')->flatMap(function($item){
            return explode(',', $item);
        })->unique()->values();

        // Filters
        $sort = request('sort');
        $perPage = request('perPage') ?? 12;
        $minPrice = request('min_price');
        $maxPrice = request('max_price');

        // Category check
        $category = Category::where('category_slug', $slug)->first();
        if ($category) {
            $query = Product::where('category_id', $category->id);
            $title = $category->category_name;
            $breadcrumb = [
                ['name' => 'Home', 'url' => route('index')],
                ['name' => $title, 'url' => ''],
            ];
            $type = 'category';
        }


        // SubCategory check
        if (!isset($query)) {
            $subcategory = Subcategory::where('subcategory_slug', $slug)->first();
            if ($subcategory) {
                $query = Product::where('subcategory_id', $subcategory->id);
                $title = $subcategory->subcategory_name;
                $breadcrumb = [
                    ['name' => 'Home', 'url' => route('index')],
                    ['name' => $subcategory->subcategory_name, 'url' => ''],
                ];
                $type = 'subcategory';
            }
        }

        // ChildCategory check
        if (!isset($query)) {
            $childcategory = Childcategory::where('childcategory_slug', $slug)->first();
            if ($childcategory) {
                $query = Product::where('childcategory_id', $childcategory->id);
                $title = $childcategory->childcategory_name;
                $breadcrumb = [
                    ['name' => 'Home', 'url' => route('index')],
                    ['name' => $childcategory->childcategory_name, 'url' => ''],
                ];
                $type = 'childcategory';
            }
        }

        if (isset($query)) {
            // Apply price filtering
            if ($minPrice !== null && $maxPrice !== null) {
                $query->whereBetween('selling_price', [$minPrice, $maxPrice]);
            }

            // Sorting
            if ($sort === 'popularity') {
                $query->orderBy('product_views', 'DESC');
            } elseif ($sort === 'newness') {
                $query->orderBy('created_at', 'DESC');
            } elseif ($sort === 'low_to_high') {
                $query->orderBy('selling_price', 'ASC');
            } elseif ($sort === 'high_to_low') {
                $query->orderBy('selling_price', 'DESC');
            }

            $products = $query->paginate($perPage)->appends(request()->query());
            $this->calculateAndSortRatings($products);

            return view('frontend.pages.category', [
                'brands' => $brands,
                'sizes' => $sizes,
                'colors' => $colors,
                'products' => $products,
                'breadcrumb' => $breadcrumb,
                'title' => $title,
                $type => $$type, // dynamically pass category/subcategory/childcategory
            ]);
        }
        abort(404);
    }



    public function ajaxSearch(Request $request)
    {
        $query = $request->get('query');

        $category_ids = Category::where(
            'category_name',
            'LIKE',
            "%{$query}%"
        )->pluck('id');

        $subcategory_ids = Subcategory::where(
            'subcategory_name',
            'LIKE',
            "%{$query}%"
        )->pluck('id');

        $childcategory_ids = Childcategory::where(
            'childcategory_name',
            'LIKE',
            "%{$query}%"
        )->pluck('id');


        $products = Product::with('colors')
            ->where(
                'product_name',
                'LIKE',
                "%{$query}%"
            )
            ->orWhere(
                'description',
                'LIKE',
                "%{$query}%"
            )
            ->orWhereIn(
                'category_id',
                $category_ids
            )
            ->orWhereIn(
                'subcategory_id',
                $subcategory_ids
            )
            ->orWhereIn(
                'childcategory_id',
                $childcategory_ids
            )
            ->limit(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DEBUG PRODUCT COLOR IMAGE
        |--------------------------------------------------------------------------
        */

        \Log::info('AJAX SEARCH PRODUCTS', [

            'query' => $query,

            'products' => $products->map(function ($product) {

                return [

                    'product_id' =>
                        $product->id,

                    'product_name' =>
                        $product->product_name,

                    'colors' =>
                        $product->colors->map(function ($color) {

                            return [

                                'color_id' =>
                                    $color->id,

                                'color' =>
                                    $color->color,

                                'thumbnail' =>
                                    $color->thumbnail,

                                'images' =>
                                    $color->images,

                            ];

                        })->toArray(),

                ];

            })->toArray(),

        ]);


        /*
        |--------------------------------------------------------------------------
        | SEARCH RESULT VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.partials.search_result',
            compact('products')
        )->render();
    }

    /*
    |--------------------------------------------------------------------------
    | FULL PAGE SEARCH RESULT
    |--------------------------------------------------------------------------
    */

    public function fullSearch($query)
    {
        $category_ids = Category::where(
            'category_name',
            'LIKE',
            "%{$query}%"
        )->pluck('id');

        $subcategory_ids = Subcategory::where(
            'subcategory_name',
            'LIKE',
            "%{$query}%"
        )->pluck('id');

        $childcategory_ids = Childcategory::where(
            'childcategory_name',
            'LIKE',
            "%{$query}%"
        )->pluck('id');


        $products = Product::with('colors')
            ->where(
                'product_name',
                'LIKE',
                "%{$query}%"
            )
            ->orWhere(
                'description',
                'LIKE',
                "%{$query}%"
            )
            ->orWhereIn(
                'category_id',
                $category_ids
            )
            ->orWhereIn(
                'subcategory_id',
                $subcategory_ids
            )
            ->orWhereIn(
                'childcategory_id',
                $childcategory_ids
            )
            ->orderBy(
                'id',
                'DESC'
            )
            ->paginate(16)
            ->withQueryString();


        return view(
            'frontend.pages.search_full_result',
            compact(
                'products',
                'query'
            )
        );
    }
    public function new()
    {
        return view('frontend.pages.new');
    }
    // About page
    public function About()
    {
        $abouts = About::all();
        return view('frontend.pages.about', compact('abouts'));
    }


      // Contact page
    public function Contact()
    {
        $contacts = ContactMessage::all();
        return view('frontend.pages.contact', compact('contacts'));
    }

    public function trendingProducts()
    {
        $brands = Brand::where('front_page', 1)->get();

        $sizes = Product::whereNotNull('size')->pluck('size')->flatMap(function($item){
            return explode(',', $item);
        })->unique()->values();

        $colors = Product::whereNotNull('color')->pluck('color')->flatMap(function($item){
            return explode(',', $item);
        })->unique()->values();

        $sort = request('sort');
        $perPage = request('perPage') ?? 12;
        $minPrice = request('min_price');
        $maxPrice = request('max_price');

        $query = Product::where('status', 1)
            ->where('trendy_product', 1)
            ->with('colors');

        if ($minPrice !== null && $maxPrice !== null) {
            $query->where(function($q) use ($minPrice, $maxPrice) {

                $q->whereBetween('discount_price', [$minPrice, $maxPrice])

                ->orWhere(function($subQ) use ($minPrice, $maxPrice) {
                    $subQ->whereNull('discount_price')
                        ->whereBetween('selling_price', [$minPrice, $maxPrice]);
                });
            });
        }

        if ($sort === 'popularity') {
            $query->orderBy('product_views', 'DESC');
        } elseif ($sort === 'newness') {
            $query->orderBy('created_at', 'DESC');
        } elseif ($sort === 'low_to_high') {
            $query->orderBy('selling_price', 'ASC');
        } elseif ($sort === 'high_to_low') {
            $query->orderBy('selling_price', 'DESC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        $products = $query->paginate($perPage)->appends(request()->query());
        $this->calculateAndSortRatings($products);

        $title = 'Trending Products';
        $breadcrumb = [
            ['name' => 'Home', 'url' => route('index')],
            ['name' => 'Trending Products', 'url' => ''],
        ];

        return view('frontend.pages.category', [
            'brands' => $brands,
            'sizes' => $sizes,
            'colors' => $colors,
            'products' => $products,
            'breadcrumb' => $breadcrumb,
            'title' => $title,
        ]);
    }
}
