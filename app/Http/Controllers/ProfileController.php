<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    // Show the user's profile
    public function show()
    {
        $user = Auth::user();
        $posts = $user->posts()->get(); // full Post models
        $articles_count = $user->posts()->count();
        return view('profile.profile', compact('user', 'articles_count', 'posts'));
    }
    // edit profile
    public function edit($userId)
    {
        $user = Auth::user();
        if ($user->id != $userId) {
            return redirect()->route('posts.profile')->with('error', 'Unauthorized access.');
        }
        return view('profile.edit_profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // force current logged-in user

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:8192',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/photos'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
