<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\guest\TestimoniController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman User)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/menu', [PageController::class, 'menu'])->name('menu');
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

/*
|--------------------------------------------------------------------------
| Admin Routes (Halaman Admin - Perlu Login)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Testimoni Management - Using singular 'testimoni' to match view expectations
    Route::resource('testimoni', \App\Http\Controllers\Admin\TestimoniController::class);
    Route::get('testimoni/{id}/approve', [\App\Http\Controllers\Admin\TestimoniController::class, 'approve'])->name('testimoni.approve');
    
    // About Us Management
    Route::prefix('about')->name('about.')->group(function () {
        Route::get('/', [AboutController::class, 'index'])->name('index');
        Route::get('/create', [AboutController::class, 'create'])->name('create');
        Route::post('/', [AboutController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AboutController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AboutController::class, 'update'])->name('update');
        Route::delete('/{id}', [AboutController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);