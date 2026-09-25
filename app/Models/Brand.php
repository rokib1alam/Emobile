<?php

namespace App\Models;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // Import Intervention Image Facade
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Brand extends Model
{
    use HasFactory;

    private static $image, $imageName, $directory, $imageUrl;

    protected $fillable = ['brand_name', 'brand_slug','front_page', 'brand_logo'];

    private static function getImageUrl($request)
    {
        self::$image = $request->file('brand_logo');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = "upload/brand-images/";
        self::$image->move(self::$directory, self::$imageName);
        // Resize the image using Intervention Image
        //create new manager instance with desred driver
        $imageManager = new ImageManager(new Driver());
        //Reading Upload imageFrom Local File system (uploads)
        $imageUrl = $imageManager->read(self::$directory .self::$imageName);
        //Resize the image
        $imageUrl->resize(240, 240); // Resize to 2, adjust as needed
        $imageUrl->save(self::$directory. self::$imageName);
        self::$imageUrl = self::$directory . self::$imageName;
        return self::$imageUrl;
    }

    public static function newBrands($request)
    {
        self::$imageUrl = $request->file('brand_logo') ? self::getImageUrl($request) : '';

        $brand = new Brand();
        self::saveBasicInfo($brand, $request, self::$imageUrl);
    }

    public static function updateBrands($request, $brand)
    {
        if ($request->file('brand_logo')) {
            if (file_exists($brand->brand_logo)) {
                unlink($brand->brand_logo);
            }
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = $brand->brand_logo;
        }
        self::saveBasicInfo($brand, $request, self::$imageUrl);
    }

    private static function saveBasicInfo($brand, $request, $imageUrl)
    {
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = Str::slug($request->brand_name, '-');
        $brand->front_page = $request->front_page;
        $brand->brand_logo = $imageUrl;
        $brand->save();
    }

    public static function deleteBrands($brand)
    {
        if (file_exists($brand->brand_logo)) {
            unlink($brand->brand_logo);
        }
        $brand->delete();
    }
    
}
