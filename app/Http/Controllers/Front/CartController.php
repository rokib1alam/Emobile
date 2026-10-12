<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
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
        $products = Cart::content()->map(function ($item) {
            $productId = explode('-', $item->id)[0];
            $item->db_product = Product::with('colors')->find($productId);
            return $item;
        });

        $cartSubtotal = (float)Cart::subtotal(2, '.', '');
        $cartTax = $cartSubtotal * 0.005; 
        $shipping = 0;
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
        $product = Product::with('colors')->find($request->id);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found!'], 404);
        }

        $colorImage = null;

        if ($request->color) {
            $selectedColor = ProductColor::where('product_id', $product->id)
                                         ->where('color', $request->color) 
                                         ->first();
            $colorImage = $selectedColor?->thumbnail; 
        }
        if (!$colorImage && $product->colors->isNotEmpty()) {
            $colorImage = $product->colors->first()?->thumbnail;
        }

        Cart::add([
            'id' => $product->id . '-' . ($request->size ?? 'default') . '-' . ($request->color ?? 'default'),
            'name' => $product->product_name,
            'qty' => $request->qty ?? 1,
            'price' => $request->price ?? $product->selling_price,
            'weight' => '1',
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'thumbnail' => $colorImage,
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
        $cartTax = $cartSubtotal * 0.005;
        $shipping = 0;
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