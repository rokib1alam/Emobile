<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;
    protected $fillable = ['pickup_point_name', 'pickup_point_address', 'pickup_point_phone','pickup_point_phone_two'];

    public static function newPickups($request)
    {
        $pickup = new self();
        self::saveBasicInfo($pickup, $request);
    }

    public static function updatePickups($request, $pickup)
    {
        self::saveBasicInfo($pickup, $request);
    }

    private static function saveBasicInfo($pickup, $request)
    {

        $pickup->pickup_point_name      = $request->pickup_point_name;
        $pickup->pickup_point_address  = $request->pickup_point_address;
        $pickup->pickup_point_phone  = $request->pickup_point_phone;
        $pickup->pickup_point_phone_two  = $request->pickup_point_phone_two;
        $pickup->save();
    }

    public static function deletePickups($pickup)
    {
        $pickup->delete();
    }
}
