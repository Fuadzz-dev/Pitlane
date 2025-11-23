<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ServiceController;

// ============================================
// GUEST ROUTES (Belum Login)
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // Authentication
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// ============================================
// AUTHENTICATED ROUTES
// ============================================
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ============================================
// ADMIN ROUTES (Role: Admin)
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('index');
        Route::get('/create', [AdminController::class, 'createUser'])->name('create');
        Route::post('/store', [AdminController::class, 'storeUser'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'editUser'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'updateUser'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'deleteUser'])->name('destroy');
    });
    
    // Motorcycles Management
    Route::prefix('motorcycles')->name('motorcycles.')->group(function () {
        Route::get('/', [AdminController::class, 'motorcycles'])->name('index');
        Route::get('/create', [AdminController::class, 'createMotorcycle'])->name('create');
        Route::post('/store', [AdminController::class, 'storeMotorcycle'])->name('store');
    });
    
    // Services Management
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [AdminController::class, 'services'])->name('index');
        Route::get('/{id}', [AdminController::class, 'showService'])->name('show');
        Route::put('/{id}/status', [AdminController::class, 'updateServiceStatus'])->name('update-status');
    });
    
    // Queue Management
    Route::prefix('queue')->name('queue.')->group(function () {
        Route::get('/', [AdminController::class, 'queue'])->name('index');
        Route::put('/{id}/update', [AdminController::class, 'updateQueue'])->name('update');
    });
    
    // Workshops Management
    Route::prefix('workshops')->name('workshops.')->group(function () {
        Route::get('/', [AdminController::class, 'workshops'])->name('index');
        Route::get('/create', [AdminController::class, 'createWorkshop'])->name('create');
        Route::post('/store', [AdminController::class, 'storeWorkshop'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'editWorkshop'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'updateWorkshop'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'deleteWorkshop'])->name('destroy');
    });
    
    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

// ============================================
// USER ROUTES (Role: User)
// ============================================
Route::middleware(['auth', 'user'])->group(function () {
    // Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Gallery
    Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
    
    // Motor
    Route::get('/motor', [HomeController::class, 'motor'])->name('motor');
    
    // Bengkel
    Route::get('/bengkel', [HomeController::class, 'bengkel'])->name('bengkel');
    
    // Service
    Route::prefix('service')->name('service.')->group(function () {
        Route::get('/', [ServiceController::class, 'create'])->name('create');
        Route::post('/store', [ServiceController::class, 'store'])->name('store');
        Route::get('/success/{id}', [ServiceController::class, 'success'])->name('success');
    });
    
    // My Queue
    Route::get('/my-queue', [ServiceController::class, 'myQueue'])->name('myQueue');
});

// ============================================
// FALLBACK ROUTE (404)
// ============================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});