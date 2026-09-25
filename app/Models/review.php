<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class review extends Model
{
    use HasFactory;
    protected $fillable = ['user_id ', 'product_id', 'review','rating','review_date','review_month','review_year'];

    public static function newReview($request)
    {
        $review = new self();
        self::saveBasicInfo($review, $request);
    }

    private static function saveBasicInfo($review, $request)
    {

        $review->user_id      = Auth::id();
        $review->product_id  = $request->product_id;
        $review->review  = $request->review;
        $review->rating  = $request->rating;
        $review->review_date  = date('d-m-y');
        $review->review_month  = date('F');
        $review->review_year  = date('Y');
        $review->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
