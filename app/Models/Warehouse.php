<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = ['warehouse_name', 'warehouse_address', 'warehouse_phone'];

    public static function newWarehouses($request)
    {
        $warehouse = new self();
        self::saveBasicInfo($warehouse, $request);
    }

    public static function updateWarehouses($request, $warehouse)
    {
        self::saveBasicInfo($warehouse, $request);
    }

    private static function saveBasicInfo($warehouse, $request)
    {

        $warehouse->warehouse_name      = $request->warehouse_name;
        $warehouse->warehouse_address  = $request->warehouse_address;
        $warehouse->warehouse_phone  = $request->warehouse_phone;
        $warehouse->save();
    }

    public static function deleteWarehouses($warehouse)
    {
        $warehouse->delete();
    }
}
