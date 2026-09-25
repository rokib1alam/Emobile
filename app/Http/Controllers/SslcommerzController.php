<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Raziul\Sslcommerz\Facades\Sslcommerz;
use Cart;

class SslcommerzController extends Controller
{
    /**
     * Handle success callback from SSLCommerz
     */
    public function success(Request $request)
    {
        $tran_id = $request->tran_id;
        $amount  = $request->amount;

        // Validate payment
        $isValid = Sslcommerz::validatePayment($request->all(), $tran_id, $amount);

        if (!$isValid) {
            return redirect()->route('cart.view')->with('error', 'Invalid payment response');
        }

        // Find order
        $order = Order::where('transaction_id', $tran_id)->first();

        if (!$order) {
            return redirect()->route('cart.view')->with('error', 'Order not found');
        }

        // Verify amount
        if ($order->amount != $amount) {
            return redirect()->route('cart.view')->with('error', 'Amount mismatch');
        }

        // Update order status
        $order->update([
            'payment_status' => 'paid',
            'status'         => 'completed',
        ]);

        // Clear cart
        Cart::destroy();

        // Send the invoice page 
        return redirect()->route('order.invoice', $order->id)
                         ->with('success', 'Payment successful!');
    }

    /**
     * Handle failure callback
     */
    public function failure(Request $request)
    {
        Order::where('transaction_id', $request->tran_id)
            ->update(['payment_status' => 'failed', 'status' => 'failed']);

        return redirect()->route('cart.view')->with('error', 'Payment failed');
    }

    /**
     * Handle cancel callback
     */
    public function cancel(Request $request)
    {
        Order::where('transaction_id', $request->tran_id)
            ->update(['payment_status' => 'cancelled', 'status' => 'cancelled']);

        return redirect()->route('cart.view')->with('error', 'Payment cancelled');
    }

    /**
     * Handle Instant Payment Notification (IPN)
     */
    public function ipn(Request $request)
    {
        $tran_id = $request->tran_id;
        $amount  = $request->amount;

        $isValid = Sslcommerz::validatePayment($request->all(), $tran_id, $amount);

        if ($isValid) {
            Order::where('transaction_id', $tran_id)
                ->update(['payment_status' => 'paid', 'status' => 'completed']);
        }

        return response()->json(['message' => 'IPN processed']);
    }
}
