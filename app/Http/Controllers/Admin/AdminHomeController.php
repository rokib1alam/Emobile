<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;

use Flasher\Toastr\Prime\ToastrInterface;
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
    public function index()
    {
        $totalEditor = Admin::role('editor')->count();
        $totalAdmin = Admin::role('admin')->count();
        $totalSuperadmin = Admin::role('super-admin')->count();

        return view('admin.dashboard', compact('totalEditor', 'totalAdmin', 'totalSuperadmin'));
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
    }
