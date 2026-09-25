<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Banner extends Model
{

    use HasFactory;

    private static $image, $imageName, $directory, $imageUrl;
     // Fillable fields to allow mass assignment
     protected $fillable = [
        'title',
        'sub_title',
        'banner_icon',
        'banner_location',
        'banner_category',
        'banner_status',
        'banner_bedroom',
        'banner_bathroom',
    ];

        // Function to upload and resize image
       // Function to upload and resize image
       private static function getImageUrl($request)
       {
           self::$image = $request->file('banner_icon');
           if (self::$image) {
               self::$imageName = time() . '_' . self::$image->getClientOriginalName(); // Unique image name
               self::$directory = "upload/banner-images/";
               self::$image->move(self::$directory, self::$imageName);
       
               // Resize the image using Intervention Image
               $imageManager = new ImageManager(new Driver());
               $image = $imageManager->read(self::$directory . self::$imageName);
               $image->resize(1200, 600); // Resize to required dimensions
               $image->save(self::$directory . self::$imageName);
       
               self::$imageUrl = self::$directory . self::$imageName;
               return self::$imageUrl;
           }
           return null;
          }
              // Create a new Banner entry
    public static function newBanner($request)
    {
        self::$imageUrl = $request->file('banner_icon') ? self::getImageUrl($request) : '';

        $banner = new self();
        self::saveBasicInfo($banner, $request, self::$imageUrl);
    }

          // Update an existing Banner entry
public static function updateBanner($request, $id)
{
 // Fetch the team record using the ID
 $banner = self::findOrFail($id);

    if ($request->file('banner_icon')) {
        if (file_exists($banner->banner_icon)) {
            unlink($banner->banner_icon);
        }
        self::$imageUrl = self::getImageUrl($request);
    } else {
        self::$imageUrl = $banner->banner_icon;
    }

    self::saveBasicInfo($banner, $request, self::$imageUrl);
    }

    // Save or update basic info in the database
   private static function saveBasicInfo($banner, $request, $imageUrl)
   {
       $banner->banner_icon                 = $imageUrl;
       $banner->title                       = $request->title;
       $banner->sub_title                   = $request->sub_title;
       $banner->sub_title                   = $request->sub_title;
       $banner->banner_location             = $request->banner_location;
       $banner->banner_category             = $request->banner_category;
       $banner->banner_status               = $request->banner_status;
       $banner->banner_bedroom              = $request->banner_bedroom;
       $banner->banner_bathroom             = $request->banner_bathroom;
       $banner->save();
   }

   
   // Delete an Property entry
public static function deleteBanner($banner)
{
    if (file_exists($banner->banner_icon)) {
        unlink($banner->banner_icon);
    }
    
    $banner->delete();
    }

}
