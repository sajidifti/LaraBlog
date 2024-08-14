<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::prefix('category')->group(function () {
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
});

Route::get('/category/{id}/posts', [CategoryController::class, 'fetchPosts'])->name('category.posts.fetch');

Route::prefix('post')->group(function () {
    Route::get('/{post:slug}', [PostController::class, 'details'])->name('post.details');
});

Route::get('/posts', [HomeController::class, 'fetchPosts'])->name('posts.fetch');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/post/store', [PostController::class, 'postStore'])->name('post.store');

    Route::post('/post/update/{post:slug}', [PostController::class, 'postUpdate'])->name('post.update');

    Route::post('/post/image-upload', [PostController::class, 'imageUpload'])->name('post.image.upload');


    Route::get('/post/{id}/details', [PostController::class, 'getPostDetails'])->name('post.details.ajax');

    Route::get('/post/{id}/delete', [PostController::class, 'postDelete'])->name('post.delete');

    Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
});
