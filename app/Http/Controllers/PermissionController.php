<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests; // for get permissions
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;
use app\Models\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends BaseController
{
    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;

        $this->middleware('permission:view permission')->only(['index']);
        $this->middleware('permission:create permission')->only(['create','store']);
        $this->middleware('permission:update permission')->only(['edit','update']);
        $this->middleware('permission:delete permission')->only(['destroy']);
    }
    public function index(){
        $permissions = Permission::all();
        $users = Admin::all();
        $roles = Role::all();
    return view('admin.role-permission.permission.index', compact('permissions','users','roles'));
    }
    public function create(){
        $permissions = Permission::all();
        return view('admin.role-permission.permission.create', compact('permissions'));

    }

    // public function store(Request $request){

    //     $request->validate([
    //         'name'=>[
    //             'required',
    //             'string',
    //             'unique: permissions, name'
    //         ]
    //     ]);

    //     Permission::newPermission($request);
    //     $this->toastr->success('Permission Created successfully!');
    //     return back();

    // }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:permissions,name',
    ]);

    Permission::create(['name' => $request->name]);
    $this->toastr->Success( 'Permission created successfully!');
    return back();
}

    public function edit($id){
        $permission = Permission::findOrFail($id);
        return view('admin.role-permission.permission.edit', compact('permission'));

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $request->name]);
        $this->toastr->addSuccess('Permission updated successfully!');
        return redirect()->route('permissions.index');
        // return redirect()->route('permissions.index')->with('success', 'Permission updated successfully!');
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        $this->toastr->addSuccess('Permission deleted successfully!');
        return redirect()->route('permissions.index');
    }
}
