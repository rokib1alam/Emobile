<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests; // for get permissions
use Flasher\Toastr\Prime\ToastrInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends BaseController
{
    use ValidatesRequests; // Include the middleware handling trait

    protected $toastr;

    public function __construct(ToastrInterface $toastr)
    {
        $this->toastr = $toastr;

        // Apply middleware to specific methods
        $this->middleware('permission:view role')->only(['index']);
        $this->middleware('permission:create role')->only(['create','store']);
        $this->middleware('permission:update role')->only(['edit','update']);
        $this->middleware('permission:delete role')->only(['destroy']);
        // Add permission for assigning role permissions
         $this->middleware('permission:give permissions')->only(['addPermissionToRole', 'givePermissionToRole']);
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
    $this->toastr->Success( 'Role created successfully!');
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
        $this->toastr->addSuccess('Role updated successfully!');
        return redirect()->route('roles.index');
        // return redirect()->route('roles.index')->with('success', 'Permission updated successfully!');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $this->toastr->addSuccess('Role deleted successfully!');
        return redirect()->route('roles.index');
    }
    public function addPermissionToRole($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->pluck('name'); // Get all permission names
        $sidebarModules = config('sidebar'); // Sidebar structure

        $groupedPermissions = [];

        // Loop through sidebar modules to categorize permissions
        foreach ($sidebarModules as $moduleName => $keywords) {
            // Initialize an array for permissions in this module
            $modulePermissions = [];

            foreach ($keywords as $keyword) {
                // Get matching permissions based on the keyword
                $matchingPermissions = $permissions->filter(function ($permission) use ($keyword) {
                    return str_contains($permission, $keyword); // Match permissions dynamically
                });

                // Add matching permissions to the modulePermissions array
                if ($matchingPermissions->isNotEmpty()) {
                    $modulePermissions[] = $matchingPermissions;
                }
            }

            // If module has permissions, add them to the groupedPermissions array
            if (!empty($modulePermissions)) {
                $groupedPermissions[$moduleName] = $modulePermissions;
            }
        }

        return view('admin.role-permission.role.add-permissions', compact('role', 'groupedPermissions'));
    }




    public function givePermissionToRole(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'required|array',
        ]);

        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permissions);

        $this->toastr->addSuccess('Permissions added to role successfully!');
        return redirect()->route('permissions.index');
    }


}
