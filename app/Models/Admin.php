<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'mobile_number',
        'gender',
        'religion',
        'blood_group',
        'profession_type',
        'division',
        'district',
        'upazila',
        'image', // changed from profile_picture to image
        'is_approved', // Admin is not approved by default
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

    // Handle the image upload and resizing
    private static function uploadImage($request)
    {
        $image = $request->file('image'); // Changed from profile_picture to image
        if ($image) {
            $imageName = time() . '_' . $image->getClientOriginalName(); // Unique image name
            $directory = "uploads/profile_pictures/";
            $image->move(public_path($directory), $imageName);

            // Resize the image using Intervention Image

            $imageManager = new ImageManager(new Driver());
            $image = $imageManager->read(public_path($directory . $imageName)); // Using read() method to load the image
            $image->resize(300, 300); // Resize to required dimensions
            $image->save(public_path($directory . $imageName)); // Save the resized image

            return $directory . $imageName; // Return the path to the image
        }
        return null;
    }

    // Create a new Admin entry with image
    public static function newAdmin($request)
    {
        $imageUrl = $request->file('image') ? self::uploadImage($request) : null;

        $admin = new self();
        $admin->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'profession_type' => $request->profession_type,
            'division' => $request->division,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'image' => $imageUrl,
            'is_approved' => null,  // You can directly set 'is_approved' here if needed
        ]);
        $admin->save();
        return $admin;
    }
    public static function updateAdmin($request, $id)
    {
        $admin = self::findOrFail($id);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            if ($admin->image && file_exists($admin->image)) {
                unlink($admin->image); // Delete old image
            }
            $admin->image = self::uploadImage($request);
        }

        $admin->fill([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'blood_group' => $request->blood_group,
            'profession_type' => $request->profession_type,
            'division' => $request->division,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'is_approved' => $request->is_approved, // Optional, based on your form
        ]);

        // Optional: Update password if provided
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        return $admin;
    }

}

