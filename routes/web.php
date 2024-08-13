<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::prefix('category')->group(function () {
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
});

Route::prefix('post')->group(function () {
    Route::get('/{post:slug}', [PostController::class, 'details'])->name('post.details');
});

Route::get('/posts', [HomeController::class, 'fetchPosts'])->name('posts.fetch');

Route::get('/test-category/{category:slug}', function (Category $category) {
    return $category->name;
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/post/store', [PostController::class, 'postStore'])->name('post.store');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});
