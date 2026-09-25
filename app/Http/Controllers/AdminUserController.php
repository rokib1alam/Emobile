<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests; // for get permissions
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;
use app\Models\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
// use Spatie\Permission\Models\Permission;

class AdminUserController extends BaseController
{


    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;

        $this->middleware('permission:view user')->only(['index']);
        $this->middleware('permission:create user')->only(['create','store']);
        $this->middleware('permission:update user')->only(['edit','update']);
        $this->middleware('permission:delete user')->only(['destroy']);
    }

    public function index(){
        $users = Admin::all();
    return view('admin.role-permission.user.index', compact('users'));
    }

    public function create()
    {
        // Fetch all roles to populate the role dropdown
        $roles = Role::all();

        return view('admin.role-permission.user.create', compact('roles'));
    }

    /**
     * Store a new user in the database.
     */

    public function store(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name,guard_name,admin', // Validate role by name and guard_name
        ]);

        // Create the admin
        // $user = Admin::create([
        //     'name' => $validatedData['name'],
        //     'email' => $validatedData['email'],
        //     'password' => Hash::make($validatedData['password']),
        //     'is_approved' => false, // Admin is not approved by default
        // ]);

        // Assign multiple roles by name to the admin
        $user->syncRoles($request->roles); // Pass role names, not IDs
        Admin::newAdmin($request);
        // Redirect with success message
        $this->toastr->success('User created successfully!');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        // Fetch the user by ID
        $user = Admin::findOrFail($id);

        // Fetch all available roles
        $roles = Role::all();

        // Pass the user and roles to the view
        return view('admin.role-permission.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'roles' => 'required|array', // Ensure roles are selected
            'roles.*' => 'exists:roles,name', // Validate that each role exists by name
            'password' => 'nullable|string|min:8|confirmed', // Optional password field with confirmation
        ]);

        // Find the user by ID
        $user = Admin::findOrFail($id);

        // If the password is provided, hash it and update the user
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        // Update the user (using your custom updateAdmin method)
        Admin::updateAdmin($request, $id);

        // Sync the selected roles to the user
        $user->syncRoles($request->roles);

        // Redirect with a success message
        $this->toastr->success('User updated successfully!');
        return redirect()->route('users.index');
    }


    // public function create()
    // {
    //     $roles = Role::all();
    //     return view('admin.role-permission.user.create', compact('roles'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:admins,email',
    //         'password' => 'required|string|min:8|confirmed',
    //         'roles' => 'required|array',
    //         'roles.*' => 'exists:roles,name,guard_name,admin',
    //     ]);

    //     Admin::newAdmin($request);

    //     $this->toastr->success('User created successfully!');
    //     return redirect()->route('users.index');
    // }

    // public function edit($id)
    // {
    //     $user = Admin::findOrFail($id);
    //     $roles = Role::all();
    //     return view('admin.role-permission.user.edit', compact('user', 'roles'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
    //         'roles' => 'required|array',
    //         'roles.*' => 'exists:roles,name,guard_name,admin',
    //         'password' => 'nullable|string|min:8|confirmed',
    //     ]);

    //     $user = Admin::findOrFail($id);


    //     $this->toastr->success('User updated successfully!');
    //     return redirect()->route('users.index');
    // }
    public function destroy($id)
    {
        // Find the user by ID
        $user = Admin::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect with a success message
        $this->toastr->success('User deleted successfully!');
        return redirect()->route('users.index');
    }

    // Approve an admin user (new method)
    public function approve($id)
    {
        // Find the admin by ID
        $admin = Admin::findOrFail($id);

        // Update the approval status
        $admin->is_approved = true;
        $admin->save();

        $this->toastr->success('Admin has been approved successfully!');
        return redirect()->route('users.index');
    }

}
