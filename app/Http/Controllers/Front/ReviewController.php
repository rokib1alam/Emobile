<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\review;
use App\Models\Wishlist;
use App\Models\Category;
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|',
            'review' => 'required|',
        ]);

        $check=review::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();

        if($check){
            $this->toastr->error('Already you have a review with this product!');
            return back();
        }

        review::newReview($request);
        $this->toastr->success('Thanks for your review!');
        return back();
    }
public function addWishlist($id)
{
    // 🔐 Check if user is logged in
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please login first to add to wishlist.');
    }

    $userId = Auth::id();

    $wishlist = Wishlist::where('product_id', $id)->where('user_id', $userId)->first();

    if ($wishlist) {
        $this->toastr->error('Already have it on your wishlist!');
    } else {
        Wishlist::newWishlist($userId, $id);
        $this->toastr->success('Added to your wishlist!');
    }

    return back();
}

    public function wishlist()
    {
        $wishlists = Wishlist::with('product')->whereHas('product')->where('user_id', auth()->id())->get();

        return view('frontend.pages.wishlist', compact('wishlists'));
    }
    public function remove(Request $request)
    {
        $wishlist = Wishlist::where('id', $request->id)->where('user_id', auth()->id())->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['message' => 'Item removed from wishlist.']);
        } else {
            return response()->json(['message' => 'Item not found!'], 404);
        }
    }



}
