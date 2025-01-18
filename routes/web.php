<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () { return view('welcome'); });

Route::resource('products', ProductController::class);
Route::get('products', [ProductController::class, 'index'])->name('products.index');//List products
Route::get('products/create', [ProductController::class, 'create'])->name('products.create'); // Show form to create a new product
Route::post('products', [ProductController::class, 'store'])->name('products.store'); // Store new product
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show'); // Show a single product
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Show form to edit an existing product
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update'); // Update product
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Delete product