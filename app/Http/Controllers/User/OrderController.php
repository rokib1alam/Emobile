<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        // চেক করো লগইন করা ইউজার এর অর্ডার কিনা
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Order এর সাথে items যদি eager load দরকার হয়
        $order->load('items.product');

        return view('frontend.user.orders-show', compact('order'));
    }
}
