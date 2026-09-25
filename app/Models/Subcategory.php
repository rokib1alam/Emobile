<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['subcategory_name', 'subcategory_slug'];

    public static function newSubCategories($request)
    {
        $subcategory = new self();
        self::saveBasicInfo($subcategory, $request);
    }

    public static function updateSubCategories($request, $subcategory)
    {
        self::saveBasicInfo($subcategory, $request);
    }

    private static function saveBasicInfo($subcategory, $request)
    {
        $subcategory->category_id       = $request->category_id;
        $subcategory->subcategory_name  = $request->subcategory_name;
        $subcategory->subcategory_slug  = Str::slug($request->subcategory_name, '-');
        $subcategory->save();
    }

    public static function deleteSubCategories($subcategory)
    {
        $subcategory->delete();
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function childCategories()
    {
        return $this->hasMany(Childcategory::class, 'subcategory_id', 'id');
    }
}

