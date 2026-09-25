<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['coupon_code', 'valid_date', 'type','coupon_amount','status'];

    public static function newCoupons($request)
    {
        $coupon = new self();
        self::saveBasicInfo($coupon, $request);
    }

    public static function updateCoupons($request, $coupon)
    {
        self::saveBasicInfo($coupon, $request);
    }

    private static function saveBasicInfo($coupon, $request)
    {

        $coupon->coupon_code      = $request->coupon_code;
        $coupon->valid_date  = $request->valid_date;
        $coupon->type  = $request->coupon_phone;
        $coupon->coupon_amount  = $request->coupon_amount;
        $coupon->status  = $request->status;
        $coupon->save();
    }

    public static function deleteCoupons($coupon)
    {
        $coupon->delete();
    }
}
