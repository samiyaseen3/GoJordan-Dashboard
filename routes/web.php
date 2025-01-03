<?php

use App\Http\Controllers\Admin\AdminContactController as AdminAdminContactController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminReviewController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TourDateController;
use App\Http\Controllers\UserSide\HomeController;
use App\Http\Controllers\UserSide\PageController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\UserSide\ReviewController;
use App\Http\Controllers\UserSide\UserTourController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LandmarkRecognitionController;
use App\Http\Controllers\UserSide\UserBookingController;
use App\Http\Controllers\UserSide\UserProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UserSide\ContactController;

/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
*/


// User Registration Routes
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);



// User Login Routes
Route::get('/user/login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [UserLoginController::class, 'login'])->name('user.login.submit');

// Admin Login Routes
Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login.submit');

// User-side routes (public-facing pages)

Route::get('/about', [PageController::class, 'about'])->name('userside.about');
Route::get('/contact', [PageController::class, 'contact'])->name('userside.contact');

Route::get('/private-tour', function () {
    return view('userside.private-tour');
})->name('userside.private-tour');

Route::get('/tours-details', function () {
    return view('userside.tours-details');
});

Route::get('/tours/full-adventure', [UserTourController::class, 'showFullAdventureTours'])->name('tours.full-adventure');
Route::get('/search', [UserTourController::class, 'search'])->name('userside.search');
Route::get('/tours/mini-adventure', [UserTourController::class, 'showMiniAdventureTours'])->name('tours.mini-adventure');
Route::get('/tours/day-adventure', [UserTourController::class, 'showDayAdventureTours'])->name('tours.day-adventure');
Route::get('/tours/all-adventure', [UserTourController::class, 'showAllAdventureTours'])->name('tours.all-adventure');
Route::get('/tour-details/{id}', [UserTourController::class, 'show'])->name('tour.details');
Route::get('/', [HomeController::class, 'index'])->name('userside.index');
Route::get('user/profile', [UserProfileController::class, 'index'])->name('userside.profile');
Route::put('user/profile/update', [UserProfileController::class, 'update'])->name('userside.update.profile');


Route::put('/user/profile/password', [UserProfileController::class, 'changePassword'])->name('userside.change.password');

//category routes

// web.php
Route::get('/tours/{categoryName}', [UserTourController::class, 'showCategoryTours'])
    ->name('tours.category');






//Review routes 

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

//contact route 

Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
// User Dashboard (authenticated users only)
Route::middleware(['auth', 'role:user'])->group(function () {


    Route::get('/booking', [UserBookingController::class, 'index'])->name('booking.page');
    Route::post('/booking/payment', [UserBookingController::class, 'storeGuests'])->name('booking.payment');
    Route::get('/booking/payment/show', [UserBookingController::class, 'showPayment'])->name('booking.payment.show');
    Route::post('/booking/payment/process', [UserBookingController::class, 'processPayment'])->name('booking.payment.process');
    Route::get('/booking/confirmation/{booking_id}', [UserBookingController::class, 'confirmation'])->name('booking.confirmation');

    Route::post('/user/logout', function () {
        auth()->logout();
        return redirect()->route('user.login');
    })->name('user.logout');
});

// Routes for authenticated admins (admin dashboard)
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Dashboard Route
    Route::get('/index', [IndexController::class, 'index'])->name('dashboard.index');

    // Admin Logout Route
    Route::post('/admin/logout', function () {
        auth()->logout();
        return redirect()->route('admin.login');
    })->name('admin.logout');

    // User management routes
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/{id}/restore', [UserController::class, 'restore'])->name('user.restore');

    // Category management routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');

    // Tour management routes
    Route::get('/tours', [TourController::class, 'index'])->name('tour.index');
    Route::get('/tours/{id}/itineraries', [TourController::class, 'showItineraries'])->name('tour.itineraries');
    Route::get('/tour/{tour}/itinerary', [TourController::class, 'showItinerary'])->name('tour.itinerary');
    Route::get('/tour/create', [TourController::class, 'create'])->name('tour.create');
    Route::post('/tour', [TourController::class, 'store'])->name('tour.store');
    Route::get('/tour/{tour}/edit', [TourController::class, 'edit'])->name('tour.edit');
    Route::put('/tour/{tour}', [TourController::class, 'update'])->name('tour.update');
    Route::delete('/tour/{tour}/images/{imageId}', [TourController::class, 'deleteImage'])->name('image.delete');
    Route::delete('/tour/{tour}', [TourController::class, 'destroy'])->name('tour.destroy');
    Route::post('/tour/{tour}/restore', [TourController::class, 'restore'])->name('tour.restore');
    // Tour Date management routes



    Route::get('/tour_dates', [TourDateController::class, 'index'])->name('tour_dates.index'); // List all tour dates
    Route::get('/tour_dates/create', [TourDateController::class, 'create'])->name('tour_dates.create'); // Show create form
    Route::post('/tour_dates', [TourDateController::class, 'store'])->name('tour_dates.store'); // Store a new tour date
    Route::get('/tour_dates/{id}', [TourDateController::class, 'show'])->name('tour_dates.show'); // Show a specific tour date
    Route::get('/tour_dates/{id}/edit', [TourDateController::class, 'edit'])->name('tour_dates.edit'); // Show edit form
    Route::put('/tour_dates/{id}', [TourDateController::class, 'update'])->name('tour_dates.update');
    Route::delete('/tour_dates/{id}', [TourDateController::class, 'destroy'])->name('tour_dates.destroy'); // Delete a specific tour date

    // Booking management routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::patch('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');

    //Reviews Routes 

    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::patch('/review/{id}/status', [AdminReviewController::class, 'updateApprovalStatus'])->name('review.status.update');
    Route::delete('/review/{id}', [AdminReviewController::class, 'destroy'])->name('review.destroy');

    //contact-us routes 

    Route::get('messages/unread-count', [AdminContactController::class, 'getUnreadCount'])
    ->name('admin.messages.unread-count');

Route::get('messages', [AdminContactController::class, 'index'])
    ->name('admin.messages.index');
Route::get('messages/{message}', [AdminContactController::class, 'show'])
    ->name('admin.messages.show');
Route::post('messages/{message}/mark-as-read', [AdminContactController::class, 'markAsRead'])
    ->name('admin.messages.mark-as-read');
Route::delete('messages/{message}', [AdminContactController::class, 'destroy'])
    ->name('admin.messages.destroy');
});



// General Dashboard Route (requires authentication)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include auth routes for user login & registration
require __DIR__ . '/auth.php';
