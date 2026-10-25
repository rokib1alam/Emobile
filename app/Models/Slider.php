<?php

namespace App\Models;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory;

    private static $image, $imageName, $directory, $imageUrl;
    protected $fillable = ['image_url', 'caption_text','heading_text'];

 private static function getImageUrl($request)
    {
        self::$image = $request->file('image_url');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = "upload/slider-images/";
        self::$image->move(self::$directory, self::$imageName);
        // Resize the image using Intervention Image
        //create new manager instance with desred driver
        $imageManager = new ImageManager(new Driver());
        //Reading Upload imageFrom Local File system (uploads)
        $imageUrl = $imageManager->read(self::$directory .self::$imageName);
        //Resize the image
        $imageUrl->resize(500, 350); // Resize to 2, adjust as needed
        $imageUrl->save(self::$directory. self::$imageName);
        self::$imageUrl = self::$directory . self::$imageName;
        return self::$imageUrl;
    }

    // Create a new Slider entry
    public static function newSlider($request)
    {
        self::$imageUrl = $request->file('image_url') ? self::getImageUrl($request) : '';
        $slider = new Slider();
        self::saveSliderInfo($slider, $request, self::$imageUrl);
    }

    // Update an existing Slider entry
    public static function updateSlider($request, $slider)
    {
        if ($request->file('image_url')) {
            if (file_exists($slider->image_url)) {
                unlink($slider->image_url);
            }
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = $slider->image_url;
        }
        self::saveSliderInfo($slider, $request, self::$imageUrl);   
    }

    // Save or update slider info in the database
    private static function saveSliderInfo($slider, $request, $imageUrl)
    {
        $slider->image_url   = $imageUrl;
        $slider->caption_text = $request->caption_text;
        $slider->heading_text = $request->heading_text;
        $slider->save();
    }

    public static function deleteSlider($slider)
    {
        if (file_exists($slider->image_url)) {
            unlink($slider->image_url);
        }
        $slider->delete();
    }
}
