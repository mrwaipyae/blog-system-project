<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|   
*/






// Route::get('/admin/ckeditor', [CkeditorController::class, 'index']);
// Route::post('/ckeditor/upload', [CkeditorController::class, 'store'])->name('posts.store');




// Route::get('admin/posts/', [PostController::class, 'index'])->name('admin.posts.index');

// ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    // dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Post index
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');
    // Post create
    Route::post('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    // Post delete
    Route::delete('/posts/{id}/destroy', [PostController::class, 'destroy'])->name('admin.posts.destroy');

    // Category index
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    // Category create
    Route::post('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    //Category update
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
    // Category delete
    Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // User
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');

    // Tag index
    Route::get('/tags', [TagController::class, 'index'])->name('admin.tags');
    // Tag create
    Route::post('/tags/create', [TagController::class, 'create'])->name('admin.tags.create');
    // Tag delete
    Route::delete('/tags/{id}/destroy', [TagController::class, 'destroy'])->name('admin.tags.destroy');
    // Tag edit
    Route::put('/tags/{id}/update',[TagController::class,'update'])->name('admin.tags.update');
});

Route::get('/', function () {
    return view('layouts/master');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
