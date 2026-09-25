<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Str;
use Raziul\Sslcommerz\Facades\Sslcommerz;
use Cart;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function show()
    {
        if (Cart::count() == 0) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        return view('frontend.pages.checkout');
    }

    /**
     * Place order and initiate SSLCommerz payment
     */
    public function placeOrder(Request $request)
    {
        // Validate input data
        $request->validate([
            'billing_fname'   => 'required|string',
            'billing_email'   => 'required|email',
            'billing_phone'   => 'required|string',
            'billing_address' => 'required|string',
            'amount'          => 'required|numeric',
            'payment_method'  => 'required|string|in:sslcommerz',
        ]);

        // Generate unique transaction id
        $tran_id = Str::uuid()->toString();

        // Create the order record
        $order = Order::create([
            'user_id'        => auth()->id(),
            'name'           => $request->billing_fname,
            'email'          => $request->billing_email,
            'phone'          => $request->billing_phone,
            'address'        => $request->billing_address,
            'amount'         => $request->amount,
            'currency'       => 'BDT',
            'transaction_id' => $tran_id,
            'status'         => 'pending',
            'payment_method' => 'sslcommerz',
            'payment_status' => 'pending',
        ]);

        // Save all order items from the cart
        foreach (Cart::content() as $cartItem) {
            // কার্ট আইডি থেকে অংশগুলো বের করো
            $parts = explode('-', $cartItem->id);

            $product_id = (int) $parts[0];  // প্রথম অংশ product_id
            $size = $parts[1] ?? null;      // দ্বিতীয় অংশ size
            $color = $parts[2] ?? null;     // তৃতীয় অংশ color

            $order->items()->create([
                'product_id' => $product_id,
                'quantity'   => $cartItem->qty,
                'price'      => $cartItem->price,
                'attributes' => json_encode([
                    'size'      => $size,
                    'color'     => $color,
                    'thumbnail' => $cartItem->options->thumbnail ?? null,
                ]),
            ]);
        }


        // Initiate payment with SSLCommerz and set callback URLs
        $response = Sslcommerz::setOrder($order->amount, $tran_id, "Order #".$order->id)
            ->setCustomer($order->name, $order->email, $order->phone)
            ->setShippingInfo(Cart::count(), $order->address)
            ->makePayment(); // callback URLs config থেকে নেওয়া হবে

        if ($response->success()) {
            return redirect($response->gatewayPageURL());
        }

        return redirect()->back()->with('error', 'Payment initiation failed');
    }

    /**
     * Show invoice page after payment success
     */
    public function invoice($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        // Authorize: only order owner can view invoice
        if (auth()->id() !== $order->user_id) {
            abort(403, 'Unauthorized access to invoice.');
        }

        return view('frontend.user.invoice', compact('order'));
    }
}
