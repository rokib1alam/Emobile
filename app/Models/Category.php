<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'category_slug','view_count','home_page'];

    public static function newCategories($request)
    {
        $category = new self();
        self::saveBasicInfo($category, $request);
    }

    public static function updateCategories($request, $category)
    {
        self::saveBasicInfo($category, $request);
    }

    private static function saveBasicInfo($category, $request)
    {
        $category->category_name  = $request->category_name;
        $category->icon  = $request->icon;
        $category->home_page  = $request->home_page;
        $category->view_count  = $request->view_count;
        $category->category_slug  = Str::slug($request->category_name, '-');
        $category->save();
    }

    public static function deleteCategory($category)
    {
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
}
