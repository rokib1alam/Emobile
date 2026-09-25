<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    use HasFactory;

    protected $fillable = ['name',];


    public static function newPermission($request)
    {
        // self::$imageUrl = $request->file('brand_logo') ? self::getImageUrl($request) : '';

        $permission = new Permission();
        // self::saveBasicInfo($permission, $request, self::$imageUrl);
    }

    public static function updatePermission($request, $permission)
    {
        // if ($request->file('brand_logo')) {
        //     if (file_exists($brand->brand_logo)) {
        //         unlink($brand->brand_logo);
        //     }
        //     self::$imageUrl = self::getImageUrl($request);
        // } else {
        //     self::$imageUrl = $brand->brand_logo;
        // }
        self::saveBasicInfo($permission, $request);
    }

    private static function saveBasicInfo($permission, $request)
    {
        $permission->name = $request->name;
        $permission->save();
    }

    // public static function deletePermission($brand)
    // {

    //     $permission->delete();
    // }
}
