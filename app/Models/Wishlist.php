<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Wishlist extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'wishlists';

    // Define the fillable attributes if necessary
    protected $fillable = [
        'product_id',
        'user_id',
        // other attributes
    ];

    public static function newWishlist($userId, $productId)
    {
        $wishlist = new self();
        self::saveBasicInfo($wishlist, $userId, $productId);
    }

    private static function saveBasicInfo($wishlist, $userId, $productId)
    {
        $wishlist->user_id = $userId;
        $wishlist->product_id = $productId;
        $wishlist->save();
    }

        public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
