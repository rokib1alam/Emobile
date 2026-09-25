<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Flasher\Toastr\Prime\ToastrInterface;

use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Message;
use App\Models\ReturnRequest;
use App\Models\Notification;

class UserDashboardController extends Controller
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {

        $this->toastr = $toastr;
    }

    /**
     * Display user dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        $this->toastr->addSuccess('Welcome to your dashboard, ' . $user->first_name . '!');

        return view('dashboard', compact(
            'user','orders'
            // 'wishlistCount',
            // 'messagesCount',
            // 'returnsCount',
            // 'notificationsCount'
        ));
    }
}
