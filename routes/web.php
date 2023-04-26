<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
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


// Route::get('admin/categories/', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('admin/categories/', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::post('admin/categories/update', [CategoryController::class, 'update'])->name('admin.categories.update');
// Route::post('category/create', [CategoryController::class, 'store'])->name('category.create');
Route::post('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');

Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');

Route::delete('admin/categories/{category}/destroy', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');



Route::get('/', function () {
    return view('admin/dashboard');
});

Route::get('admin/posts/', [PostController::class, 'index'])->name('admin.posts.index');
// Route::get('admin/posts/', function () {
//     return view('admin/posts');
// })->name('admin.posts.index');

// Route::get('/admin/categories',function(){
//     return view('admin/categories');
// })->name('admin.categories');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
