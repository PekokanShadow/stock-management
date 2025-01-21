<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Show form to create a new role
    public function index()
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('view role')) {
            return view('inventory.noakses');
        }
        $query = Role::query();
        // Execute the query and paginate the results, showing 10 items per page
        $roles = $query->paginate(10);
        return view('profile.role', compact('roles'));
    }
    public function create()
    {
        // Fetch all permissions
        $userLogin = Auth::user();
        if (!$userLogin->can('create role')) {
            return view('inventory.noakses');
        }
        $permissions = Permission::all();

        return view('profile.createrole', compact('permissions'));
    }

    // Store the newly created role with selected permissions
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',  // Must select at least one permission
        ]);
        // Create the new role
        $roles = Role::create(['name' => $request->name]);

        // Attach the selected permissions to the role
        $roles->syncPermissions($request->permissions);

        return redirect()->route('role.index')->with('success', 'Role created successfully!');
    }

    public function edit($id)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('edit role')) {
            return view('inventory.noakses');
        }
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('profile.editrole', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Validate request
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'array'
        ]);

        // Update role name
        $role->name = $request->name;
        $role->save();

        // Sync permissions
        $role->syncPermissions($request->permissions);

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }


    public function destroy(Role $role)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('delete role')) {
            return view('inventory.noakses');
        }
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
    }
}
