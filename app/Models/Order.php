<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'amount',
        'currency',
        'transaction_id',
        'status',
        'payment_method',
        'payment_status',
        'ipn_response'
    ];

    // Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

}
