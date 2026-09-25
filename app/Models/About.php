<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class About extends Model
{
    use HasFactory;

    private static $image, $imageName, $directory, $imageUrl;

    protected $fillable = [
        'image',
        'heading',
        'subheading',
        'paragraph_1',
        'paragraph_2',
    ];

    // Upload and resize image
    private static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        if (self::$image) {
            self::$imageName = time() . '_' . self::$image->getClientOriginalName();
            self::$directory = 'upload/about/';
            self::$image->move(self::$directory, self::$imageName);

            $manager = new ImageManager(new Driver());
            $image = $manager->read(self::$directory . self::$imageName);
            $image->resize(800, 400)->save(self::$directory . self::$imageName);

            self::$imageUrl = self::$directory . self::$imageName;
            return self::$imageUrl;
        }
        return null;
    }

    // Create new About record
    public static function newAbout($request)
    {
        self::$imageUrl = $request->file('image') ? self::getImageUrl($request) : '';

        $about = new self();
        self::saveBasicInfo($about, $request, self::$imageUrl);
    }

    // Update About record
    public static function updateAbout($request, $id)
    {
        $about = self::findOrFail($id);

        if ($request->file('image')) {
            if (file_exists($about->image)) {
                unlink($about->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = $about->image;
        }

        self::saveBasicInfo($about, $request, self::$imageUrl);
    }

    // Save or update data
    private static function saveBasicInfo($about, $request, $imageUrl)
    {
        $about->image        = $imageUrl;
        $about->heading      = $request->heading;
        $about->subheading   = $request->subheading;
        $about->paragraph_1  = $request->paragraph_1;
        $about->paragraph_2  = $request->paragraph_2;
        $about->save();
    }

    // Delete About record
    public static function deleteAbout($about)
    {
        if (file_exists($about->image)) {
            unlink($about->image);
        }
        $about->delete();
    }
}
