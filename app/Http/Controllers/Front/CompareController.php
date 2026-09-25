<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{

    public function viewCompare()
    {
        $compare = session()->get('compare', []);

            // IDs সংগ্রহ করে প্রোডাক্ট ডাটাগুলো রিয়েল টাইমে ডাটাবেস থেকে আনো
            $compareProducts =Product::whereIn('id', array_keys($compare))->get();

            return view('frontend.pages.compare', compact('compareProducts'));
    }
    // Add product to compare list (AJAX)
    public function addToCompare($id)
    {
        $product = Product::findOrFail($id);
        $compare = session()->get('compare', []);

        if (!isset($compare[$id])) {
            $compare[$id] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'slug' => $product->product_slug,
                'image' => $product->thumbnail,
                'price' => $product->discount_price ?? $product->selling_price,
                'rating' => $product->reviews->avg('rating') ?? 0,
                'description' => $product->description,
                'colors' => $product->color,
                'sizes' => $product->size,
                'stock' => $product->stock_quantity > 0 ? 'In Stock' : 'Out Of Stock',
            ];
            session()->put('compare', $compare);

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to compare list'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'message' => 'Product already in compare list'
            ]);
        }
    }

    // Remove product from compare list (optional)
    public function removeFromCompare($id)
    {
        $compare = session()->get('compare', []);
        if (isset($compare[$id])) {
            unset($compare[$id]);
            session()->put('compare', $compare);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product removed from compare list'
        ]);
    }
}
