<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'division',
        'district',
        'upazila',
        'union',
        'postcode',
        'address_details',
        'image',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    private static $image, $imageName, $directory, $imageUrl;

    private static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = time() . '_' . self::$image->getClientOriginalName();
        self::$directory = "upload/user/";

        // Move the uploaded image
        self::$image->move(public_path(self::$directory), self::$imageName);

        // Resize the image using Intervention Image
        $imageManager = new ImageManager(new Driver());
        $imagePath = public_path(self::$directory . self::$imageName);
        $image = $imageManager->read($imagePath);
        $image->resize(300, 300)->save($imagePath);

        self::$imageUrl = self::$directory . self::$imageName;
        return self::$imageUrl;
    }

    private static function saveBasicInfo($user, $request, $imageUrl)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->division = $request->division;
        $user->district = $request->district;
        $user->upazila = $request->upazila;
        $user->union = $request->union;
        $user->postcode = $request->postcode;
        $user->address_details = $request->address_details;
        $user->image = $imageUrl;

         // ✅ Check if new password provided, then update
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();
    }

    public static function updateUser($request, $id)
    {
        $user = self::findOrFail($id);

        // Image delete + upload
        if ($request->file('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = $user->image;
        }

        // Save basic fields
        self::saveBasicInfo($user, $request, self::$imageUrl);
    }
}
