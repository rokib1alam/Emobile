<?php

namespace App\Http\Controllers;

use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;
    }
    public function index(){
        $roles = Role::all();
    return view('admin.role-permission.role.index', compact('roles'));
    }
    public function create(){
        $roles = Role::all();
        return view('admin.role-permission.role.create', compact('roles'));

    }

    // public function store(Request $request){

    //     $request->validate([
    //         'name'=>[
    //             'required',
    //             'string',
    //             'unique: roles, name'
    //         ]
    //     ]);

    //     Permission::newPermission($request);
    //     $this->toastr->success('Permission Created successfully!');
    //     return back();

    // }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:roles,name',
    ]);

    Role::create(['name' => $request->name]);
    $this->toastr->success( 'Role created successfully!');
    return redirect()->route('roles.index');
}

    public function edit($id){
        $role = Role::findOrFail($id);
        return view('admin.role-permission.role.edit', compact('role'));

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->name]);
        $this->toastr->success('Role updated successfully!');
        return redirect()->route('roles.index');
        // return redirect()->route('roles.index')->with('success', 'Permission updated successfully!');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $this->toastr->success('Role deleted successfully!');
        return redirect()->route('roles.index');
    }
    public function addPermissionToRole($id){
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        return view('admin.role-permission.role.add-permissions', compact('role','permissions'));
    }
    public function givePermissionToRole(Request $request, $id){
        $request->validate([
            'permissions' => 'required',
        ]);
        // $permissions = Permission::all();
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permissions);
        return view('admin.role-permission.role.add-permissions', compact('role','permissions'));
        $this->toastr->success('Permissions added to role successfully!');
        return redirect()->back();
    }
     
}
