<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function Index(Request $request)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('view user')) {
            return view('inventory.noakses');
        }
        $query = User::query();
        // Execute the query and paginate the results, showing 10 items per page
        $users = $query->paginate(10); // Pagination with 10 records per page

        // Pass users to the view
        return view('profile.user', compact('users'));
    }

    public function edit($id)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('edit user')) {
            return view('inventory.noakses');
        }
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('profile.edituser', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate request
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        // Update user details
        $user->username = $request->username;
        $user->name = $request->name;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Sync roles
        $user->syncRoles([$request->role]);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }



    public function createuser()
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('create user')) {
            return view('inventory.noakses');
        }
        // Fetch all roles for assignment
        $roles = Role::all();
        // Return the view for creating a new user
        return view('profile.createuser', compact('roles')); // Make sure this view exists
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        // Create the user
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        // Assign the role
        $user->assignRole($request->role);

        // Optional: If you need to manage additional permissions manually
        if ($request->has('permissions')) {
            $user->permissions = json_encode($request->permissions);
            $user->save();
        }

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }


    public function destroy(User $user)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('delete user')) {
            return view('inventory.noakses');
        }
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
