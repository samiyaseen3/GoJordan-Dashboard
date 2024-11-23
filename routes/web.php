<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;

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




  Route::get('/' , function(){
    return view('welcome');
  });

  
  Route::middleware(['auth' , 'role:admin'])->group(function () {
    Route::get('/index', [IndexController::class , 'index'])->name('dashboard.index');
    // users routes
    
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/create' , [UserController::class , 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{user}/edit' , [UserController::class , 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('/user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');

//categories routes

Route::get('/category' , [CategoryController::class , 'index'])->name('category.index');
Route::get('/category/create' , [CategoryController::class , 'create'])->name('category.create');
Route::post('/category' , [CategoryController::class , 'store'])->name('category.store');
Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{category}' , [CategoryController::class , 'destroy'])->name('category.destroy');
Route::post('/category/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');

//tours routs

Route::get('/tours', [TourController::class, 'index'])->name('tour.index');
Route::get('/tours/{id}/itineraries', [TourController::class, 'showItineraries'])->name('tour.itineraries');
Route::get('/tour/{tour}/itinerary', [TourController::class, 'showItinerary'])->name('tour.itinerary');
Route::get('/tour/create', [TourController::class, 'create'])->name('tour.create');
Route::post('/tour', [TourController::class, 'store'])->name('tour.store');
Route::get('/tour/{tour}/edit' , [TourController::class , 'edit'])->name('tour.edit');
Route::put('/tour/{tour}' , [TourController::class , 'update'])->name('tour.update');
Route::delete('tour/{tour}/images/{imageId}', [TourController::class, 'deleteImage'])->name('image.delete');
Route::delete('tour/{tour}', [TourController::class, 'destroy'])->name('tour.destroy');
Route::post('tour/{tour}/restore', [TourController::class, 'restore'])->name('tour.restore');

//bookings
Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
// In web.php or api.php
Route::patch('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');

});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
