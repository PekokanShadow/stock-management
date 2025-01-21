<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:8',
        ]);

        $user->username = $request->username;
        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('settings.index')->with('success', 'Admin account updated successfully.');
    }
}
