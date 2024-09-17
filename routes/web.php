<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [WebsiteController::class, 'index'])->name('website');

Route::get('/dashboard', function () {
    //return view('dashboard');
    return view('admin.dashboard');

})->middleware(['auth'])->name('dashboard');

// Category
Route::get('dashboard/category', [CategoryController::class, 'index'])->name('all_category');
Route::get('dashboard/category/add', [CategoryController::class, 'add'])->name('add_category');
Route::get('dashboard/category/edit/{slug}', [CategoryController::class, 'edit'])->name('edit_category');
Route::post('dashboard/category/submit', [CategoryController::class, 'submit'])->name('submit_category');
Route::post('dashboard/category/update', [CategoryController::class, 'update'])->name('update_category');

// Service
Route::get('dashboard/service', [ServiceController::class, 'index'])->name('all_service');
Route::get('dashboard/service/add', [ServiceController::class, 'add'])->name('add_service');
Route::get('dashboard/service/edit/{slug}', [ServiceController::class, 'edit'])->name('edit_service');
Route::get('dashboard/service/view/{slug}', [ServiceController::class, 'view'])->name('view_service');
Route::post('dashboard/service/submit', [ServiceController::class, 'submit'])->name('submit_service');
Route::post('dashboard/service/update', [ServiceController::class, 'update'])->name('update_service');
Route::post('dashboard/service/delete', [ServiceController::class, 'delete'])->name('delete_service');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('all/book/information', [WebsiteController::class, 'allBook'])->name('allBook');
    Route::post('book/service/confirm', [WebsiteController::class, 'confirm_booking'])->name('confirm_booking');
});

// Service booking
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('book/service/{id}', [WebsiteController::class, 'bookService'])->name('book_service');
    Route::post('book/service/submit', [WebsiteController::class, 'bookServiceSubmit'])->name('bookServiceSubmit');
    Route::get('customer/book/information', [WebsiteController::class, 'customerBook'])->name('customerBook');
});

// Website service view
Route::get('service/view/{id}', [WebsiteController::class, 'view'])->name('web_view_service');

// Submit review
Route::middleware(['auth', 'customer'])->group(function () {
    Route::post('review/submit', [WebsiteController::class, 'reviewSubmit'])->name('reviewSubmit');
});

require __DIR__.'/auth.php';
