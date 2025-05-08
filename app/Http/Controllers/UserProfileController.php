<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Bug;

class UserProfileController extends Controller
{
    public function reviews()
    {
        return view('user.profile.reviews');
    }

    public function info()
    {
        return view('user.profile.info');
    }

    public function alerts()
    {
        return view('user.profile.alerts');
    }

    public function accounts()
    {
        return view('user.profile.accounts');
    }

    public function email()
    {
        return view('user.profile.email');
    }

    public function password()
    {
        return view('user.profile.password');
    }

    public function bugs()
    {
        return view('user.profile.bugs');
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,name,'.Auth::id(),
            'phone' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'gender' => 'nullable|string|in:male,female',
        ]);

        $user = Auth::user();
        $user->name = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->description = $request->description;
        $user->gender = $request->gender;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('avatars', 'public');
            $user->avatar = 'storage/' . $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    // Implement other update methods similarly
}