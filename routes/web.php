<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;
use App\Http\Controllers\ProductController;
// Route::get('/', function () {
//     return view('home.index');
// });

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware((['auth', 'admin']));

Route::get('view_category', [AdminController::class, 'view_category'])->middleware((['auth', 'admin']))->name('view_category');
Route::post('add_category', [AdminController::class, 'store_category'])->middleware((['auth', 'admin']))->name('add_category');
Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->middleware((['auth', 'admin']))->name('delete_category');
Route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->middleware((['auth', 'admin']))->name('edit_category');
Route::post('update_category/{id}', [AdminController::class, 'update_category'])->middleware((['auth', 'admin']))->name('update_category');


Route::get('view_product', [ProductController::class, 'create'])->middleware((['auth', 'admin']))->name('view_product');
Route::post('add_product', [ProductController::class, 'store'])->middleware((['auth', 'admin']))->name('add_product');
Route::get('show_product', [ProductController::class, 'index'])->middleware((['auth', 'admin']))->name('show_product');
Route::get('delete_product/{id}', [ProductController::class, 'delete'])->middleware((['auth', 'admin']))->name('delete_product');
Route::get('edit_product/{id}', [ProductController::class, 'edit'])->middleware((['auth', 'admin']))->name('edit_product');
Route::put('update_product/{id}', [ProductController::class, 'update'])->middleware((['auth', 'admin']))->name('update_product');
Route::get('product_details/{id}', [ProductController::class, 'product_details'])->name('product_details');
Route::get('add_cart/{id}', [ProductController::class, 'add_cart'])->name('add_cart')->middleware(['auth', 'verified']); //if the user is authenticated and verified, they can add products to the cart
Route::get('my_cart', [ProductController::class, 'my_cart'])->name('my_cart')->middleware(['auth', 'verified']);
Route::get('remove_my_cart/{id}', [ProductController::class, 'remove_my_cart'])->name('remove_my_cart')->middleware(['auth', 'verified']);
Route::post('order_confirm', [ProductController::class, 'order_confirm'])->name('order_confirm')->middleware(['auth', 'verified']);
