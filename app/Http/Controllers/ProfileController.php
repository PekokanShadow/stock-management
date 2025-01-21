<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.account'); // Returns the `profile.blade.php` view
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate the incoming request
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        // Update the user's data
        $user->username = $request->username;
        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Account updated successfully.');
    }
}
