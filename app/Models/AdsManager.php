<?php

namespace App\Models;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // Import Intervention Image Facade
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdsManager extends Model
{
    use HasFactory;

    private static $image, $imageName, $directory, $imageUrl;

    protected $fillable = ['category_id', 'title', 'discount_text', 'banner_position', 'link', 'image'];

    private static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = time() . '_' . self::$image->getClientOriginalName();
        self::$directory = "upload/ads-images/";
        self::$image->move(self::$directory, self::$imageName);
        
        // Resize the image using Intervention Image
        // create new manager instance with desired driver
        $imageManager = new ImageManager(new Driver());
        // Reading Upload image From Local File system (uploads)
        $imageUrl = $imageManager->read(self::$directory . self::$imageName);
        
        // Resize the image (adjust width, height as needed for banners)
        $imageUrl->resize(800, 450); 
        $imageUrl->save(self::$directory . self::$imageName);
        
        self::$imageUrl = self::$directory . self::$imageName;
        return self::$imageUrl;
    }

    public static function newAds($request)
    {
        self::$imageUrl = $request->file('image') ? self::getImageUrl($request) : '';

        $ads = new AdsManager();
        self::saveBasicInfo($ads, $request, self::$imageUrl);
    }

    public static function updateAds($request, $ads)
    {
        if ($request->file('image')) {
            if (file_exists($ads->image)) {
                unlink($ads->image);
            }
                self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = $ads->image;
        }
        self::saveBasicInfo($ads, $request, self::$imageUrl);
    }

    private static function saveBasicInfo($ads, $request, $imageUrl)
    {
        $ads->category_id     = $request->category_id;
        $ads->title           = $request->title;
        $ads->discount_text   = $request->discount_text;
        $ads->banner_position = $request->banner_position;
        $ads->link            = $request->link;
        $ads->image           = $imageUrl;
        $ads->save();
    }

    public static function deleteAds($ads)
    {
        if (file_exists($ads->image)) {
            unlink($ads->image);
        }
        $ads->delete();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}