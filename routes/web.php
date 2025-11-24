<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\QueueController as AdminQueueController;
use App\Http\Controllers\Admin\WorkshopController as AdminWorkshopController;

// User Controllers
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ServiceController as UserServiceController;
use App\Http\Controllers\User\QueueController as UserQueueController;
use App\Http\Controllers\User\GalleryController;
use App\Http\Controllers\User\MotorController;
use App\Http\Controllers\User\BengkelController;

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
Route::middleware(['auth', 'admin'])->group(function () {
    
    // Dashboard (tanpa prefix admin di URL)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Admin Routes dengan prefix
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Users Management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminUserController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
        });
        
        // Motorcycles Management (ADDED)
        Route::prefix('motorcycles')->name('motorcycles.')->group(function () {
            Route::get('/', function() { 
                return view('admin.motorcycles.index'); 
            })->name('index');
        });
        
        // Services Management
        Route::prefix('services')->name('services.')->group(function () {
            Route::get('/', [AdminServiceController::class, 'index'])->name('index');
            Route::get('/{id}', [AdminServiceController::class, 'show'])->name('show');
            Route::put('/{id}/status', [AdminServiceController::class, 'updateStatus'])->name('update-status');
        });
        
        // Queue Management
        Route::prefix('queue')->name('queue.')->group(function () {
            Route::get('/', [AdminQueueController::class, 'index'])->name('index');
            Route::put('/{id}/update', [AdminQueueController::class, 'update'])->name('update');
        });
        
        // Workshops Management
        Route::prefix('workshops')->name('workshops.')->group(function () {
            Route::get('/', [AdminWorkshopController::class, 'index'])->name('index');
            Route::get('/create', [AdminWorkshopController::class, 'create'])->name('create');
            Route::post('/store', [AdminWorkshopController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [AdminWorkshopController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminWorkshopController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminWorkshopController::class, 'destroy'])->name('destroy');
        });
        
        // Settings (ADDED)
        Route::get('/settings', function() { 
            return view('admin.settings'); 
        })->name('settings');
    });
});

// ============================================
// USER ROUTES (Role: User)
// ============================================
Route::middleware(['auth', 'user'])->group(function () {
    
    // Home (tanpa prefix user)
    Route::get('/home', [HomeController::class, 'index'])->name('user.home');
    
    // Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    
    // Motor
    Route::get('/motor', [MotorController::class, 'index'])->name('motor');
    
    // Bengkel
    Route::get('/bengkel', [BengkelController::class, 'index'])->name('bengkel');
    Route::get('/bengkel/{id}', [BengkelController::class, 'show'])->name('bengkel.show');
    
    // Service
    Route::get('/service', [UserServiceController::class, 'create'])->name('service');
    Route::post('/service/store', [UserServiceController::class, 'store'])->name('service.store');
    Route::get('/service/success/{id}', [UserServiceController::class, 'success'])->name('service.success');
    
    // Queue
    Route::get('/queue/my-queue', [UserQueueController::class, 'myQueue'])->name('queue.my-queue');
    Route::get('/queue/{id}', [UserQueueController::class, 'detail'])->name('queue.detail');
});
