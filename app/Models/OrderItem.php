<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'attributes',
    ];

    // Relation to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Optional: Relation to Product (jodi Product model thake)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
