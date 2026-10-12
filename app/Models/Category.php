<?php

namespace App\Models;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    private static $image, $imageName, $directory, $imageUrl;

    protected $fillable = ['category_name', 'category_slug', 'category_image', 'view_count', 'home_page'];

    private static function getImageUrl($request)
    {
        self::$image = $request->file('category_image');
        self::$imageName = time() . '_' . self::$image->getClientOriginalName();
        self::$directory = "upload/category-images/";
        
        if (!file_exists(self::$directory)) {
            mkdir(self::$directory, 0777, true);
        }

        self::$image->move(self::$directory, self::$imageName);

        // Intervention Image দিয়ে রিসাইজ
        $imageManager = new ImageManager(new Driver());
        $imageUrl = $imageManager->read(self::$directory . self::$imageName);
        $imageUrl->resize(240, 240); // আপনার প্রয়োজনমতো সাইজ পরিবর্তন করতে পারেন
        $imageUrl->save(self::$directory . self::$imageName);

        self::$imageUrl = self::$directory . self::$imageName;
        return self::$imageUrl;
    }

    public static function newCategories($request)
    {
        self::$imageUrl = $request->file('category_image') ? self::getImageUrl($request) : '';

        $category = new self();
        self::saveBasicInfo($category, $request, self::$imageUrl);
    }

    public static function updateCategories($request, $category)
    {
        if ($request->file('category_image')) {
            if (file_exists($category->category_image)) {
                unlink($category->category_image);
            }
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = $category->category_image;
        }

        self::saveBasicInfo($category, $request, self::$imageUrl);
    }

    private static function saveBasicInfo($category, $request, $imageUrl)
    {
        $category->category_name  = $request->category_name;
        $category->icon           = $request->icon;
        $category->home_page      = $request->home_page;
        $category->view_count     = $request->view_count;
        $category->category_slug  = Str::slug($request->category_name, '-');
        $category->category_image = $imageUrl;
        $category->save();
    }

    public static function deleteCategory($category)
    {
        if (file_exists($category->category_image)) {
            unlink($category->category_image);
        }
        $category->delete();
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')->where('status', 1);
    }
    public function ads()
    {
        return $this->hasMany(AdsManager::class, 'category_id', 'id')->where('status', 1);
    }
}