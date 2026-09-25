<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Childcategory extends Model
{
    use HasFactory;
    protected $fillable = ['childcategory_name', 'childcategory_slug', 'subcategory_id', 'category_id'];

    public static function newChildCategories($request)
    {
        $childcategory = new self();
        self::saveBasicInfo($childcategory, $request);
    }

    public static function updateChildCategories($request, $childcategory)
    {
        self::saveBasicInfo($childcategory, $request);
        $childcategory->save();
    }

    private static function saveBasicInfo($childcategory, $request)
    {
       // Fetch the subcategory based on subcategory_id from the request
       $subcategory = Subcategory::find($request->subcategory_id);

       if ($subcategory) {
           // Assign the category_id from the subcategory
           $childcategory->category_id = $subcategory->category_id;
       }
        $childcategory->subcategory_id      = $request->subcategory_id;
        $childcategory->childcategory_name  = $request->childcategory_name;
        $childcategory->childcategory_slug  = Str::slug($request->childcategory_name, '-');
        $childcategory->save();
    }

    public static function deleteChildCategories($childcategory)
    {
        $childcategory->delete();
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
