<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use App\Models\Post as Post;
use Illuminate\Foundation\Auth\User as AuthUser;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Access denied. Admins only.');
        }
        return view('dashboard.dash_board');
    }
    public function users()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Access denied. Admins only.');
        }
        $users = User::all();
        return view('dashboard.users', compact('users'));
    }

    public function articles()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Access denied. Admins only.');
        }
        $posts = Post::all();
        return view('dashboard.articles', compact('posts'));
    }
    public function deleteUser(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Access denied. Admins only.');
        }
        if ($user) {
            $user->delete();
            return redirect()->route('users')->with('success', 'User deleted successfully.');
        }
        return redirect()->route('users')->with('error', 'User not found.');
    }
    public function deleteArticle(Post $article)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Access denied. Admins only.');
        }
        if ($article) {
            $article->delete();
            return redirect()->route('articles')->with('success', 'Article deleted successfully.');
        }
        return redirect()->route('articles')->with('error', 'Article not found.');
    }
    public function createUser()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Access denied. Admins only.');
        }
        return view('dashboard.createuser'); // just returns the form
    }

    public function storeUser(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('posts.index')->with('error', 'Access denied. Admins only.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users')->with('success', 'User created successfully.');
    }
}
