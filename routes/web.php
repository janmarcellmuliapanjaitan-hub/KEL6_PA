<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Guest\AboutController as GuestAboutController;
use App\Http\Controllers\Guest\MenuController as GuestMenuController;
use App\Http\Controllers\Guest\PromoController as GuestPromoController;
use App\Http\Controllers\Guest\GalleryController as GuestGalleryController;
use App\Http\Controllers\Guest\LocationController as GuestLocationController;
use App\Http\Controllers\guest\TestimoniController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Guest\ContactController as GuestContactController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\TestimoniController as AdminTestimoniController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman User)
|--------------------------------------------------------------------------
*/
Route::get('/', [GuestHomeController::class, 'index'])->name('home');
Route::get('/about', [GuestAboutController::class, 'index'])->name('about');
Route::get('/menu', [GuestMenuController::class, 'index'])->name('menu');
Route::get('/promo', [GuestPromoController::class, 'index'])->name('promo');
Route::get('/gallery', [GuestGalleryController::class, 'index'])->name('gallery');
Route::get('/location', [GuestLocationController::class, 'index'])->name('location');
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
Route::get('/kontak', [GuestContactController::class, 'index'])->name('kontak');
Route::get('/contacts', [GuestContactController::class, 'index'])->name('contacts');

/*sss
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

    Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Halaman Admin - Perlu Login)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Menu Management
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/', [MenuController::class, 'store'])->name('store');
        Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
        Route::put('/{menu}', [MenuController::class, 'update'])->name('update');
        Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
        Route::patch('/{menu}/toggle-status', [MenuController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Order Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/confirm-wa', [OrderController::class, 'confirmWaView'])->name('confirm-wa-view');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        Route::delete('/{id}', [OrderController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/approve', [OrderController::class, 'approve'])->name('approve');
        Route::post('/{id}/cancel', [OrderController::class, 'cancel'])->name('cancel');
    });
    
    // Promo Management
    Route::prefix('promo')->name('promo.')->group(function () {
        Route::get('/', [PromoController::class, 'index'])->name('index');
        Route::get('/create', [PromoController::class, 'create'])->name('create');
        Route::post('/', [PromoController::class, 'store'])->name('store');
        Route::get('/{promo}/edit', [PromoController::class, 'edit'])->name('edit');
        Route::put('/{promo}', [PromoController::class, 'update'])->name('update');
        Route::delete('/{promo}', [PromoController::class, 'destroy'])->name('destroy');
    });

    // Gallery Management
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::get('/create', [GalleryController::class, 'create'])->name('create');
        Route::post('/', [GalleryController::class, 'store'])->name('store');
        Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('edit');
        Route::put('/{gallery}', [GalleryController::class, 'update'])->name('update');
        Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('destroy');
    });

    // Location Management
    Route::prefix('locations')->name('locations.')->group(function () {
        Route::get('/', [LocationController::class, 'index'])->name('index');
        Route::get('/create', [LocationController::class, 'create'])->name('create');
        Route::post('/', [LocationController::class, 'store'])->name('store');
        Route::get('/{location}/edit', [LocationController::class, 'edit'])->name('edit');
        Route::put('/{location}', [LocationController::class, 'update'])->name('update');
        Route::delete('/{location}', [LocationController::class, 'destroy'])->name('destroy');
    });

    // Testimoni Management
    Route::prefix('testimoni')->name('testimoni.')->group(function () {
        Route::get('/', [AdminTestimoniController::class, 'index'])->name('index');
        Route::delete('/{id}', [AdminTestimoniController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/approve', [AdminTestimoniController::class, 'approve'])->name('approve');
    });
    
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

    // System Settings Management
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::put('/', [SettingController::class, 'update'])->name('update');
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


// Guest (Pelanggan) Auth Routes
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('/login', [LoginController::class, 'showGuestLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'guestLogin'])->name('login');
    
    Route::get('/register', [RegisterController::class, 'showGuestRegistrationForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'guestRegister'])->name('register');
});
