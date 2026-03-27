<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\guest\TestimoniController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Guest\ContactController as GuestContactController;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman User)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/promo', [PageController::class, 'promo'])->name('promo');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/location', [PageController::class, 'location'])->name('location');
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
Route::get('/kontak', [GuestContactController::class, 'index'])->name('kontak');
Route::get('/contacts', [GuestContactController::class, 'index'])->name('contacts');

/*
|--------------------------------------------------------------------------
| Guest Protected Routes (Pelanggan)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{menu}', [\App\Http\Controllers\Guest\CartController::class, 'add'])->name('guest.cart.add');
    Route::get('/cart', [\App\Http\Controllers\Guest\CartController::class, 'index'])->name('guest.cart.index');
    Route::put('/cart/update/{id}', [\App\Http\Controllers\Guest\CartController::class, 'update'])->name('guest.cart.update');
    Route::delete('/cart/remove/{id}', [\App\Http\Controllers\Guest\CartController::class, 'remove'])->name('guest.cart.remove');

    Route::get('/checkout', [\App\Http\Controllers\Guest\CheckoutController::class, 'index'])->name('guest.checkout.index');
    Route::post('/checkout/process', [\App\Http\Controllers\Guest\CheckoutController::class, 'process'])->name('guest.checkout.process');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Halaman Admin - Perlu Login)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Menu Management
    Route::resource('menu', \App\Http\Controllers\Admin\MenuController::class);

    // Order Management
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'destroy']);
    
    // Promo Management
    Route::resource('promo', \App\Http\Controllers\Admin\PromoController::class);

    // Gallery Management
    Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class);

    // Location Management
    Route::resource('locations', \App\Http\Controllers\Admin\LocationController::class);

    // Testimoni Management
    Route::resource('testimoni', \App\Http\Controllers\Admin\TestimoniController::class);
    Route::post('testimoni/{id}/approve', [\App\Http\Controllers\Admin\TestimoniController::class, 'approve'])->name('testimoni.approve');
    
    // About Us Management
    Route::prefix('about')->name('about.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::get('/create', [AboutController::class, 'create'])->name('create');
        Route::post('/', [AboutController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AboutController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AboutController::class, 'update'])->name('update');
        Route::delete('/{id}', [AboutController::class, 'destroy'])->name('destroy');
    });
    
    // CONTACT MANAGEMENT 
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/create', [ContactController::class, 'create'])->name('create');
        Route::post('/', [ContactController::class, 'store'])->name('store');
        Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('edit');
        Route::put('/{contact}', [ContactController::class, 'update'])->name('update');
        Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
// Admin Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Guest (Pelanggan) Auth Routes
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/login', [LoginController::class, 'showGuestLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'guestLogin'])->name('login');
    
    Route::get('/register', [RegisterController::class, 'showGuestRegistrationForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'guestRegister'])->name('register');
});
