<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // Import Intervention Image Facade
use Illuminate\Support\Str;

class Campaing extends Model
{
    use HasFactory;
    private static $image, $imageName, $directory, $imageUrl, $slug;

    protected $fillable = ['title', 'start_date', 'end_date','image','status','discount','month','year'];

    private static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$slug . '.' . self::$image->getClientOriginalExtension();
        self::$directory = "upload/campaing-images/";
        self::$image->move(self::$directory, self::$imageName);
        // Resize the image using Intervention Image
        // Create new manager instance with desired driver
        $imageManager = new ImageManager(new Driver());
        // Reading Upload imageFrom Local File system (uploads)
        $imageUrl = $imageManager->read(self::$directory .self::$imageName);
        // Resize the image
        $imageUrl->resize(468, 90); // Resize to 468x90, adjust as needed
        $imageUrl->save(self::$directory . self::$imageName);
        self::$imageUrl = self::$directory . self::$imageName;
        return self::$imageUrl;
    }

    public static function newCampaings($request)
    {
        self::$slug = Str::slug($request->title, '-'); // Set slug based on title
        self::$imageUrl = $request->file('image') ? self::getImageUrl($request) : '';

        $campaing = new campaing();
        self::saveBasicInfo($campaing, $request, self::$imageUrl);
    }

    public static function updateCampaings($request, $campaing)
    {
        self::$slug = Str::slug($request->title, '-'); // Set slug based on title
        if ($request->file('image')) {
            if (file_exists($campaing->image)) {
                unlink($campaing->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = $campaing->image;
        }
        self::saveBasicInfo($campaing, $request, self::$imageUrl);
    }

    private static function saveBasicInfo($campaing, $request, $imageUrl)
    {
        $campaing->title = $request->title;
        $campaing->start_date = $request->start_date;
        $campaing->end_date = $request->end_date;
        $campaing->image = $imageUrl;
        $campaing->status = $request->status;
        $campaing->discount = $request->discount;
        $campaing->month = date('F');
        $campaing->year = date('Y');
        $campaing->save();
    }

    public static function deleteCampaings($campaing)
    {
        if (file_exists($campaing->image)) {
            unlink($campaing->image);
        }
        $campaing->delete();
    }
}
