<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductColor;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_slug',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'pickup_point_id',
        'product_name',
        'product_code',
        'unit',
        'tags',
        'material',
        'size',
        'video',
        'purchase_price',
        'selling_price',
        'discount_price',
        'stock_quantity',
        'warehouse',
        'description',
        'featured',
        'today_deal',
        'status',
        'admin_id',
        'date',
        'month'
    ];


    /*
    |--------------------------------------------------------------------------
    | Create Product
    |--------------------------------------------------------------------------
    */

    public static function newProduct($request)
    {
        $product = new Product();

        self::saveBasicInfo(
            $product,
            $request
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Product
    |--------------------------------------------------------------------------
    */

    public static function updateProduct(
        $request,
        $product
    ) {

        self::saveBasicInfo(
            $product,
            $request
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Save Product Information
    |--------------------------------------------------------------------------
    */

    private static function saveBasicInfo(
        $product,
        $request
    ) {

        $subcategory =
            Subcategory::find(
                $request->subcategory_id
            );


        /*
        |--------------------------------------------------------------------------
        | Category Information
        |--------------------------------------------------------------------------
        */

        $product->category_id =
            $subcategory
                ? $subcategory->category_id
                : null;

        $product->subcategory_id =
            $request->subcategory_id;

        $product->childcategory_id =
            $request->childcategory_id ?: null;


        /*
        |--------------------------------------------------------------------------
        | Brand & Pickup Point
        |--------------------------------------------------------------------------
        */

        $product->brand_id =
            $request->brand_id;

        $product->pickup_point_id =
            $request->pickup_point_id;


        /*
        |--------------------------------------------------------------------------
        | Product Information
        |--------------------------------------------------------------------------
        */

        $product->product_name =
            $request->product_name;

        $product->product_slug =
            Str::slug(
                $request->product_name,
                '-'
            );

        $product->product_code =
            $request->product_code;

        $product->unit =
            $request->unit;

        $product->tags =
            $request->tags;

        $product->material =
            $request->material;

        $product->size =
            $request->size;

        $product->video =
            $request->video;


        /*
        |--------------------------------------------------------------------------
        | Price Information
        |--------------------------------------------------------------------------
        */

        $product->purchase_price =
            $request->purchase_price;

        $product->selling_price =
            $request->selling_price;

        $product->discount_price =
            $request->discount_price;


        /*
        |--------------------------------------------------------------------------
        | Stock Information
        |--------------------------------------------------------------------------
        */

        $product->stock_quantity =
            $request->stock_quantity;

        $product->warehouse =
            $request->warehouse;


        /*
        |--------------------------------------------------------------------------
        | Description
        |--------------------------------------------------------------------------
        */

        $product->description =
            $request->description;


        /*
        |--------------------------------------------------------------------------
        | Product Status
        |--------------------------------------------------------------------------
        */

        $product->featured =
            $request->featured;

        $product->today_deal =
            $request->today_deal;

        $product->product_slider =
            $request->product_slider;

        $product->trendy_product =
            $request->trendy_product;

        $product->status =
            $request->status;


        /*
        |--------------------------------------------------------------------------
        | Admin Information
        |--------------------------------------------------------------------------
        */

        $product->admin_id =
            Auth::id();

        $product->date =
            date('d-m-y');

        $product->month =
            date('F');


        /*
        |--------------------------------------------------------------------------
        | Save Product
        |--------------------------------------------------------------------------
        */

        $product->save();
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Product
    |--------------------------------------------------------------------------
    */

    public static function deleteProduct($product)
    {

        /*
        |--------------------------------------------------------------------------
        | Delete Product Colors
        |--------------------------------------------------------------------------
        */

        $productColors =
            $product->colors;


        foreach (
            $productColors as $productColor
        ) {

            ProductColor::deleteProductColor(
                $productColor
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Product
        |--------------------------------------------------------------------------
        */

        $product->delete();
    }


    /*
    |--------------------------------------------------------------------------
    | Category Relation
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Subcategory Relation
    |--------------------------------------------------------------------------
    */

    public function subcategory()
    {
        return $this->belongsTo(
            Subcategory::class,
            'subcategory_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Childcategory Relation
    |--------------------------------------------------------------------------
    */

    public function childcategory()
    {
        return $this->belongsTo(
            Childcategory::class,
            'childcategory_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Brand Relation
    |--------------------------------------------------------------------------
    */

    public function brand()
    {
        return $this->belongsTo(
            Brand::class,
            'brand_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Pickup Point Relation
    |--------------------------------------------------------------------------
    */

    public function pickuppoint()
    {
        return $this->belongsTo(
            Pickup::class,
            'pickup_point_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Review Relation
    |--------------------------------------------------------------------------
    */

    public function reviews()
    {
        return $this->hasMany(
            review::class,
            'product_id',
            'id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Product Color Relation
    |--------------------------------------------------------------------------
    |
    | Product
    |    ├── Red
    |    │    ├── Thumbnail
    |    │    └── Images
    |    │
    |    ├── Blue
    |    │    ├── Thumbnail
    |    │    └── Images
    |    │
    |    └── Black
    |         ├── Thumbnail
    |         └── Images
    |
    |--------------------------------------------------------------------------
    */

    public function colors()
    {
        return $this->hasMany(
            ProductColor::class,
            'product_id'
        );
    }
}

