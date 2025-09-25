<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

Route::get('login', fn() => view('auth.login'))->name('login')->middleware('guest');
Route::get('register', fn() => view('auth.register'))->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login.req');
Route::post('register', [AuthController::class, 'register'])->name('register.req');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('profile', [ProfileController::class, 'show'])->name('posts.profile')->middleware('auth');
Route::get('profile/{user}', [ProfileController::class, 'userPosts'])->name('posts.userPosts')->middleware('auth');
Route::get('profile/edit/{user}', [ProfileController::class, 'edit'])->name('posts.profile.edit')->middleware('auth');
Route::put('profile/update', [ProfileController::class, 'update'])->name('posts.profile.update')->middleware('auth');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');


// Comment routes
Route::post('posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like')->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/users', [DashboardController::class, 'users'])->name('users')->middleware('auth');
Route::get('/dashboard/articles', [DashboardController::class, 'articles'])->name('articles')->middleware('auth');
Route::get('/dashboard/articles/delete/{article}', [DashboardController::class, 'deleteArticle'])->name('articles.delete')->middleware('auth');
Route::get('/dashboard/users/delete/{user}', [DashboardController::class, 'deleteUser'])->name('users.delete')->middleware('auth');
Route::get('/dashboard/users/create', [DashboardController::class, 'createUser'])->name('users.create')->middleware('auth');
Route::post('/dashboard/users/create', [DashboardController::class, 'storeUser'])->name('users.store')->middleware('auth');
