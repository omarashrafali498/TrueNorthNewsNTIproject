<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:25',
            'password' => 'required|confirmed|string|min:6',
        ]);
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('posts.index');
    }


    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:200',
            'password' => 'required|string|min:6',
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('posts.index');
        }

        return redirect()->back()->withErrors(['login' => 'Invalid Data!']);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('login');
    }
}
