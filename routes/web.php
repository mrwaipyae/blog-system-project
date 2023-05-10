<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

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





// ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    // dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Post index
    Route::get('/posts', [AdminPostController::class, 'index'])->name('admin.posts');

    // Post creation
    Route::get('posts/new', [AdminPostController::class, 'newPost'])->name('admin.posts.new');
    Route::post('/posts', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts/uploadFile', [AdminPostController::class, 'uploadFile'])->name('uploadFile');

    // Post edit, update, publish and delete
    Route::get('/posts/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{id}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::put('/posts/{id}/un-publish', [AdminPostController::class, 'un_or_publish'])->name('admin.posts.publish');
    Route::delete('/posts/{id}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');

    // Post show
    Route::get('/posts/{user}/{titleAndId}', [AdminPostController::class, 'show'])->name('admin.post.show');

    // Category index
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    // Category create
    Route::post('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    //Category update
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
    // Category delete
    Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // User index
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    // User view
    Route::post('/users/{name}', [AdminUserController::class, 'view'])->name('admin.users.view');

    // Tag index
    Route::get('/tags', [AdminTagController::class, 'index'])->name('admin.tags');
    // Tag creation
    Route::post('/tags/create', [AdminTagController::class, 'create'])->name('admin.tags.create');
    // Tag update/delete
    Route::put('/tags/{id}/update', [AdminTagController::class, 'update'])->name('admin.tags.update');
    Route::delete('/tags/{id}/destroy', [AdminTagController::class, 'destroy'])->name('admin.tags.destroy');
    // Tag view
    Route::post('/tags/{name}', [AdminTagController::class, 'view'])->name('admin.tags.view');
});

// USER

Route::get('/', [PostController::class, 'index']);
Route::get('/{user}-{id}',[UserController::class,'showPosts'])->name('user.posts');
Route::get('/new',[PostController::class,'new'])->name('post.new');
Route::post('/create-post', [PostController::class, 'create'])->name('post.create');
Route::get('/tag/{tag}', [TagController::class,'showPosts'])->name('tag.show');
Route::get('/{user}/{titleAndId}', [PostController::class, 'view'])->name('post.view');
Route::post('/{post}/like', [PostLikeController::class, 'likePost'])->middleware('auth')->name('post.like');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
