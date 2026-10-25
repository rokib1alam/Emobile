<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Show checkout page and fetch product details via product_id
     */
    public function show(Request $request)
    {
        $productId = $request->query('product_id');
        if (!$productId) {
            return redirect('/')->with('error', 'Please select a product first!');
        }
        $product = Product::findOrFail($productId);
        return view('frontend.pages.checkout', compact('product'));
    }

    /**
     * Place order (Cash on Delivery) - Admin Approval Mode
     */
    public function placeOrder(Request $request)
    {
        // ইনপুট ভ্যালিডেশন
        $request->validate([
            'billing_fname'   => 'required|string|max:255',
            'billing_phone'   => ['required', 'string', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
            'billing_email'   => 'required|email:rfc,dns', 
            'billing_address' => 'required|string',
            'product_id'      => 'required|exists:products,id',
            'quantity'        => 'required|integer|min:1',
        ], [
            'billing_phone.regex'    => 'দয়া করে একটি সঠিক বাংলাদেশী ফোন নম্বর দিন (যেমন: 017XXXXXXXX)।',
            'billing_email.required' => 'ইমেইল অ্যাড্রেস প্রদান করা বাধ্যতামূলক।',
            'billing_email.email'    => 'দয়া করে একটি সঠিক ও ভ্যালিড ইমেইল অ্যাড্রেস দিন।',
        ]);

        $product = Product::findOrFail($request->product_id);

        // মূল্য ও ডেলিভারি চার্জ হিসাব (ডেলিভারি চার্জ ১৫০ টাকা)
        $unitPrice = $product->discount_price ?? $product->selling_price;
        $productTotal = $unitPrice * $request->quantity;
        $deliveryCharge = 150; 
        $totalAmount = $productTotal + $deliveryCharge;

        // ইউনিক ইনভয়েস কোড জেনারেট
        $invoice = 'ORD-' . strtoupper(Str::random(6));

        // ডাটাবেজে অর্ডার তৈরি (প্রাথমিক স্ট্যাটাস pending থাকবে)
        $order = Order::create([
            'user_id'          => auth()->check() ? auth()->id() : null,
            'name'             => $request->billing_fname,
            'email'            => $request->billing_email,
            'phone'            => $request->billing_phone,
            'address'          => $request->billing_address,
            'amount'           => $totalAmount,
            'currency'         => 'BDT',
            'transaction_id'   => 'COD-' . strtoupper(Str::random(10)), // সিকিউর ট্রানজেকশন আইডি
            'status'           => 'pending', // অ্যাডমিন এপ্রুভ করার আগ পর্যন্ত পেন্ডিং থাকবে
            'payment_method'   => 'Cash on Delivery',
            'payment_status'   => 'pending',
        ]);

        // অর্ডার আইটেম সেভ
        $order->items()->create([
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
            'price'      => $unitPrice,
            'attributes' => json_encode([
                'size'  => $request->size ?? null,
                'color' => $request->color ?? null,
            ]),
        ]);

        // নোট: কাস্টমার অর্ডার করার সাথে সাথে Steadfast API কল হবে না। 
        // অ্যাডমিন প্যানেল থেকে এপ্রুভ করার পর Steadfast-এ পার্সেল বুকিং হবে।

        return redirect()->route('order.invoice', $order->transaction_id)
                         ->with('success', 'আপনার অর্ডারটি সফলভাবে সম্পন্ন হয়েছে!');
    }

    /**
     * Show invoice page using transaction_id
     */
    public function invoice($transactionId)
    {
        $order = Order::with('items.product')->where('transaction_id', $transactionId)->firstOrFail();
        
        // নিরাপত্তা যাচাই: অন্য কেউ যাতে ইউরআলে আইডি বদলে অন্যের ইনভয়েস দেখতে না পারে
        if ($order->user_id !== null && auth()->check() && auth()->id() !== $order->user_id) {
            abort(403, 'Unauthorized access to invoice.');
        }

        return view('frontend.user.invoice', compact('order'));
    }
}