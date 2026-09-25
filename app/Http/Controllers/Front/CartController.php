<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Flasher\Toastr\Prime\ToastrInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
    }

    public function index()
    {

        // Cart item এর সাথে DB product attach করে দিচ্ছি
        $products = Cart::content()->map(function ($item) {
            $item->db_product = Product::find($item->id);
            return $item;
        });

            $cartSubtotal = (float)Cart::subtotal(2, '.', '');
            $cartTax = $cartSubtotal * 0.005; // ১০% ট্যাক্স
            $shipping = 0; // নির্দিষ্ট শিপিং চার্জ
            $cartTotal = $cartSubtotal + $cartTax + $shipping;

        return view('frontend.cart.view_cart', [
            'products' => $products,
            'cartSubtotal' => number_format($cartSubtotal, 2, '.', ''),
            'cartTax' => number_format($cartTax, 2, '.', ''),
            'shipping' => number_format($shipping, 2, '.', ''),
            'cartTotal' => number_format($cartTotal, 2, '.', '')
        ]);
    }

    public function addToCartQV(Request $request)
    {
        $product = Product::find($request->id);

        Cart::add([
            'id' => $product->id . '-' . $request->size . '-' . $request->color,
            'name' => $product->product_name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => '1',
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'thumbnail' => $product->thumbnail,
            ],
        ])->associate(Product::class);

        return response()->json(['status' => 'success', 'message' => 'Product added to cart successfully.!']);
    }

    public function getCartItems()
    {
        $cartItems = Cart::content();
        $subtotal = Cart::subtotal();
        $cartCount = Cart::count();

        $cartItemsArray = $cartItems->map(function ($item) {
            return [
                'rowId' => $item->rowId,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'options' => [
                    'thumbnail' => $item->options->thumbnail
                ]
            ];
        });

        return response()->json([
            'cartItems' => $cartItemsArray,
            'subtotal' => $subtotal,
            'cartCount' => $cartCount,
        ]);
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => true, 'message' => 'Product removed from cart successfully.']);
    }
    public function update(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        Cart::update($rowId, $qty);

        $productSubtotal = Cart::get($rowId)->subtotal(2, '.', '');

        $cartSubtotal = (float)Cart::subtotal(2, '.', '');

        $cartTax = $cartSubtotal * 0.005; // ১০% ট্যাক্স

        $shipping = 0; // নির্দিষ্ট শিপিং চার্জ

        $cartTotal = $cartSubtotal + $cartTax + $shipping;

        return response()->json([
            'success' => true,
            'message' => 'Product quantity updated successfully.',
            'cartSubtotal' => number_format($cartSubtotal, 2, '.', ''),
            'cartTax' => number_format($cartTax, 2, '.', ''),
            'cartShipping' => number_format($shipping, 2, '.', ''),
            'cartTotal' => number_format($cartTotal, 2, '.', ''),
            'updatedSubtotal' => number_format($productSubtotal, 2, '.', ''),
        ]);
    }

}
