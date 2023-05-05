<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\PagesController;

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

Route::get('/pageindex', [PagesController::class, 'index']);
Route::post('/submitform', [PagesController::class, 'submitform'])->name('submitform');
Route::post('/uploadFile', [PagesController::class, 'uploadFile'])->name('uploadFile');




// Route::get('/admin/ckeditor', [CkeditorController::class, 'index']);
// Route::post('/ckeditor/upload', [CkeditorController::class, 'store'])->name('posts.store');




// Route::get('admin/posts/', [PostController::class, 'index'])->name('admin.posts.index');


// ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    // dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Post index
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');

    // Post creation
    Route::get('posts/new', [PostController::class, 'newPost'])->name('admin.posts.new');
    Route::post('/posts', [PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts/uploadFile',[PostController::class,'uploadFile'])->name('uploadFile');

    // Post edit, update, publish and delete
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::put('/posts/{id}/un-publish', [PostController::class, 'un_or_publish'])->name('admin.posts.publish');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
   
    // Post show
    Route::get('/posts/{user}/{titleAndId}', [PostController::class, 'show'])->name('post.show');

    // Category index
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    // Category create
    Route::post('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    //Category update
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
    // Category delete
    Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');


    // User index
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    // User view
    Route::post('/users/{name}',[UserController::class,'view'])->name('admin.users.view');


    // Tag index
    Route::get('/tags', [TagController::class, 'index'])->name('admin.tags');
    // Tag creation
    Route::post('/tags/create', [TagController::class, 'create'])->name('admin.tags.create');
    // Tag update/delete
    Route::put('/tags/{id}/update', [TagController::class, 'update'])->name('admin.tags.update');
    Route::delete('/tags/{id}/destroy', [TagController::class, 'destroy'])->name('admin.tags.destroy');
    // Tag view
    Route::post('/tags/{name}',[TagController::class,'view'])->name('admin.tags.view');
});

Route::get('/', function () {
    return view('layouts/master');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
