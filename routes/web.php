<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Halaman utama
Route::get('/', function () {
    return view('login');
});

Route::get('test', function () {
    echo 'test';
});

// Routes Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home Routes (dengan HomeController)
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])
//         ->name('dashboard');
// });


// ✅ Tambahkan Routes untuk Service Pages
Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

// Service - PASTIKAN INI ADA
Route::get('/service', function() {
    return view('form');
})->name('service');

Route::post('/service', [ServiceController::class, 'store'])->name('service.store');

Route::get('/motor', function () {
    return view('motor');
})->name('motor');

Route::get('/bengkel', function () {
    return view('bengkel');
})->name('bengkel');