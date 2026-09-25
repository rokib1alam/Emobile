<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // Import Intervention Image Facade

class Setting extends Model
{
    use HasFactory;

    private static $directory, $imageUrl, $faviconUrl;

    protected $fillable = [
        'currency', 'phone_one', 'phone_two', 'main_email',
        'support_email', 'logo', 'favicon', 'address','opening_time',
        'facebook', 'twitter', 'instragram', 'linkedin', 'youtube'
    ];

    private static function getImageUrl($imageFile, $directory, $resizeWidth = null, $resizeHeight = null)
    {
        $imageName =uniqid().'.'. $imageFile->getClientOriginalExtension(); // Ensure a unique file name
        $imageFile->move($directory, $imageName);

        // Resize the image if dimensions are provided
        if ($resizeWidth && $resizeHeight) {
            // Create new manager instance with desired driver
            $imageManager = new ImageManager(new Driver());

            // Read uploaded image from local filesystem (uploads)
            $imageUrl = $imageManager->read($directory . $imageName);

            // Resize the image
            $imageUrl->resize($resizeWidth, $resizeHeight);

            // Save the resized image
            $imageUrl->save($directory . $imageName);

            // Set the final image URL
            $imageUrl = $directory . $imageName;
        } else {
            // If no resizing is needed, just set the URL to the original image path
            $imageUrl = $directory . $imageName;
        }

        return $imageUrl;
    }

    public static function updateSetting($request, $setting)
    {
        self::$directory = "upload/setting/";

        if ($request->file('logo')) {
            if (file_exists($setting->logo)) {
                unlink($setting->logo); // Delete the previous logo
            }
            self::$imageUrl = self::getImageUrl($request->file('logo'), self::$directory, 112, 112); // Resize logo to 320x120
        } else {
            self::$imageUrl = $setting->logo;
        }

        if ($request->file('favicon')) {
            if (file_exists($setting->favicon)) {
                unlink($setting->favicon); // Delete the previous favicon
            }
            self::$faviconUrl = self::getImageUrl($request->file('favicon'), self::$directory, 32, 32); // Resize favicon to 32x32
        } else {
            self::$faviconUrl = $setting->favicon;
        }

        self::saveBasicInfo($setting, $request, self::$imageUrl, self::$faviconUrl);
    }

    private static function saveBasicInfo($setting, $request, $imageUrl, $faviconUrl)
    {
        $setting->currency = $request->currency;
        $setting->phone_one = $request->phone_one;
        $setting->phone_two = $request->phone_two;
        $setting->main_email = $request->main_email;
        $setting->support_email = $request->support_email;
        $setting->logo = $imageUrl;
        $setting->favicon = $faviconUrl;
        $setting->address = $request->address;
        $setting->opening_time = $request->opening_time;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instragram = $request->instragram;
        $setting->linkedin = $request->linkedin;
        $setting->youtube = $request->youtube;

        $setting->save();
    }
}
