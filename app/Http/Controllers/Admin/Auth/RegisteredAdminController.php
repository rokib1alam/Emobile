<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Flasher\Toastr\Prime\ToastrInterface;
use App\Models\Admin;
use App\Models\User; // Assuming super admins are in the User model
use App\Notifications\NewAdminRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class RegisteredAdminController extends Controller
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
    }
    // Show pending admins
    public function index(Request $request)
    {
        $status = $request->get('status');

        $query = Admin::query();

        if ($status === 'approved') {
            $query->where('is_approved', 1);
        } elseif ($status === 'rejected') {
            $query->where('is_approved', 0);
        } elseif ($status === 'pending') {
            $query->whereNull('is_approved');
        }

        $admins = $query->get();

        return view('admin.registered.index', compact('admins', 'status'));
    }
    public function create()
    {
        return view('admin.auth.register');
    }
    // Store a new admin (called after validation)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|confirmed|min:8',
            'mobile_number' => 'nullable|string|max:15',
            'gender' => 'nullable|string|max:10',
            'religion' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:10',
            'profession_type' => 'nullable|string|max:255',
            'division' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'upazila' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $admin = Admin::newAdmin($request); // Store admin
        $this->toastr->success('Admin User info Added successfully!');
        // Notify all super admins
        $superAdmins = Admin::role('super-admin')->get();
        Notification::send($superAdmins, new NewAdminRegistered($admin));

        return redirect()->route('admin.login')->with('success', 'Admin registered successfully.');
    }

    // Approve a pending admin
    public function approve($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->is_approved = true;
        $admin->save();

        return back()->with('success', 'Admin approved successfully.');
    }

    // Reject (or delete) a pending admin
    public function reject($id)
    {
        $admin = Admin::findOrFail($id);

        // Only reject if the admin's status is still pending (null)
        if ($admin->is_approved === null) {
            $admin->is_approved = 0; // Mark as rejected
            $admin->save();

            return redirect()->route('registered-admins.index')->with('success', 'Admin rejected successfully.');
        }

        return redirect()->route('registered-admins.index')->with('error', 'Admin status cannot be changed.');
    }

}
