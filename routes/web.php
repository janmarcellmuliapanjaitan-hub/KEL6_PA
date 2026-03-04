<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Halaman Public
Route::get('/', [PageController::class, 'home'])->name('home'); // Ubah dari 'welcome' jadi 'home' biar konsisten
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/testimoni', [PageController::class, 'testimoni'])->name('testimoni');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

// Halaman Admin (dengan middleware auth)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Menu
    Route::resource('menus', MenuController::class); // Ubah dari 'menu' jadi 'menus' biar konsisten dengan resource
    
    // Testimoni
    Route::resource('testimonials', TestimonialController::class);
    
    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store'); // Tambah store
    Route::put('/contact/{id}', [ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy'); // Tambah delete
    
    // Location
    Route::get('/location', [LocationController::class, 'index'])->name('location.index');
    Route::post('/location', [LocationController::class, 'store'])->name('location.store'); // Tambah store
    Route::put('/location/{id}', [LocationController::class, 'update'])->name('location.update');
    Route::delete('/location/{id}', [LocationController::class, 'destroy'])->name('location.destroy'); // Tambah delete
    
    // About Us - Gunakan resource agar dapat CRUD lengkap
    Route::prefix('about')->name('about.')->controller(AboutController::class)->group(function () {
    Route::get('/', 'index')->name('index');           // List
    Route::get('/create', 'create')->name('create');   // Form create
    Route::post('/', 'store')->name('store');          // Simpan data
    Route::get('/{id}/edit', 'edit')->name('edit');    // Form edit
    Route::put('/{id}', 'update')->name('update');     // Update data
    Route::delete('/{id}', 'destroy')->name('destroy'); // Hapus data
});
});

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
