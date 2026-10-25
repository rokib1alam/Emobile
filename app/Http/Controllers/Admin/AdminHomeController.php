<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class AdminHomeController extends Controller
{
    protected $toastr;
    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
    }
    public function index(Request $request)
    {
        $totalEditor = Admin::role('editor')->count();
        $totalAdmin = Admin::role('admin')->count();
        $totalSuperadmin = Admin::role('super-admin')->count();

        $query = Order::latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        return view('admin.dashboard', compact('totalEditor', 'totalAdmin', 'totalSuperadmin', 'orders'));
    }


public function show()
{
    $admin = Auth::guard('admin')->user();
    return view('admin.adminprofile.profile', compact('admin'));
}
public function edit()
{
    $admin = Auth::guard('admin')->user();
    return view('admin.adminprofile.edit', compact('admin'));
}

public function update(Request $request)
{
    $admin = Auth::guard('admin')->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email,' . $admin->id,
        'mobile_number' => 'nullable|string|max:20',
        'gender' => 'nullable|string',
        'religion' => 'nullable|string',
        'blood_group' => 'nullable|string',
        'profession_type' => 'nullable|string',
        'division' => 'nullable|string',
        'district' => 'nullable|string',
        'upazila' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    Admin::updateAdmin($request, $admin->id);

    $this->toastr->success('Profile updated successfully!');
    return back();
}

    // password change page
     public function passwordChange(){
        return view('admin.profile.password_change');
    }
    //Password Update
    public function passwordUpdate(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $current_password=Auth::user()->password;
        $oldpass=$request->old_password;

        if (Hash::check($oldpass,$current_password)){
            $user=Admin::findorfail(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();
            $this->toastr->success('You Password Change!');
            return redirect()->route('admin.login');
        }else{
            $this->toastr->error('Old Password Not Matched!');
            return redirect()->back();
        }
    }

    public function sendToSteadfast($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        // যদি ইতিপূর্বেই ট্র্যাকিং কোড থাকে, তবে ডাবল বুকিং আটকাবে
        if (!empty($order->steadfast_tracking_code)) {
            return back()->with('error', 'এই অর্ডারটি ইতিপূর্বেই Steadfast-এ পাঠানো হয়েছে!');
        }

        // টেস্ট মোড কন্ট্রোল (true থাকলে ডামি ডাটা কাজ করবে, false হলে রিয়েল API কল হবে)
        $isTesting = true; // লাইভে যাওয়ার সময় শুধু এটি false করে দেবেন

        try {
            if ($isTesting) {
                // ১. টেস্ট মোড ট্রু হলে ডামি ডাটা দিয়ে আপডেট করবে
                $order->update([
                    'steadfast_consignment_id' => 'CONS-DUMMY-' . rand(1000, 9999),
                    'steadfast_tracking_code'  => 'TRK-DUMMY-' . rand(100000, 999999),
                    'status'                   => 'processing',
                ]);

                return back()->with('success', '[Test Mode] অর্ডারটি সফলভাবে এপ্রুভ হয়েছে এবং ডামি ট্র্যাকিং কোড যুক্ত হয়েছে!');
            } else {
                // ২. টেস্ট মোড ফলস হলে মেইন/রিয়েল Steadfast API কল করবে
                $response = Http::withHeaders([
                    'Api-Key'      => env('STEADFAST_API_KEY'),
                    'Secret-Key'   => env('STEADFAST_SECRET_KEY'),
                    'Content-Type' => 'application/json',
                ])->withoutVerifying()
                ->post('https://portal.packzy.com/api/v1/create_order', [
                    'invoice'           => $order->transaction_id,
                    'recipient_name'    => $order->name,
                    'recipient_phone'   => $order->phone,
                    'recipient_address' => $order->address,
                    'amount_to_collect' => $order->amount,
                    'item_quantity'     => $order->items->sum('quantity'),
                    'item_description'  => 'Product Order',
                ]);

                if ($response->successful()) {
                    $resData = $response->json();
                    
                    if (isset($resData['status']) && $resData['status'] == 200 && isset($resData['consignment'])) {
                        $order->update([
                            'steadfast_consignment_id' => $resData['consignment']['consignment_id'],
                            'steadfast_tracking_code'  => $resData['consignment']['tracking_code'],
                            'status'                   => 'processing',
                        ]);

                        return back()->with('success', 'অর্ডারটি সফলভাবে Steadfast-এ পাঠানো হয়েছে এবং ট্র্যাকিং কোড যুক্ত হয়েছে!');
                    }
                }

                return back()->with('error', 'Steadfast API Error: ' . $response->body());
            }

        } catch (\Exception $e) {
            \Log::error('Steadfast Exception: ' . $e->getMessage());
            return back()->with('error', 'Exception: ' . $e->getMessage());
        }
    }

    public function handleSteadfastWebhook(Request $request)
    {
        // Steadfast থেকে পাঠানো ডেটা লগ করে রাখার জন্য (Debugging)
        Log::info('Steadfast Webhook Received:', $request->all());

        $trackingCode   = $request->input('tracking_code');
        $deliveryStatus = $request->input('status'); // Steadfast সাধারণত 'delivered', 'cancelled', 'in_transit' পাঠায়

        if ($trackingCode) {
            $order = Order::where('steadfast_tracking_code', $trackingCode)->first();

            if ($order) {
                // Steadfast থেকে ডেলিভারি কনফার্মেশন আসলে ডাটাবেজ অটো আপডেট হবে
                if ($deliveryStatus == 'delivered') {
                    $order->update(['status' => 'delivered']);
                } elseif ($deliveryStatus == 'cancelled' || $deliveryStatus == 'returned') {
                    $order->update(['status' => 'cancelled']);
                }

                return response()->json(['status' => 'success', 'message' => 'Order status updated successfully']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
    }

    }
