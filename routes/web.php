<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\QueueController as AdminQueueController;
use App\Http\Controllers\Admin\WorkshopController as AdminWorkshopController;
use App\Http\Controllers\Admin\MotorcycleController;
use App\Http\Controllers\Admin\MekanikController;
use App\Http\Controllers\Admin\FinanceController;

// User Controllers
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ServiceController as UserServiceController;
use App\Http\Controllers\User\QueueController as UserQueueController;
use App\Http\Controllers\User\HistoryController;
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
            Route::get('/', [MotorcycleController::class, 'index'])->name('index');
            Route::get('/create', [MotorcycleController::class, 'create'])->name('create');
            Route::post('/store', [MotorcycleController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [MotorcycleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [MotorcycleController::class, 'update'])->name('update');
            Route::delete('/{id}', [MotorcycleController::class, 'destroy'])->name('destroy');
        });
        
        // Layanan Management
        Route::prefix('layanan')->name('layanan.')->group(function () {
            Route::get('/', [LayananController::class, 'index'])->name('index');
            Route::get('/create', [LayananController::class, 'create'])->name('create');
            Route::post('/store', [LayananController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [LayananController::class, 'edit'])->name('edit');
            Route::put('/{id}', [LayananController::class, 'update'])->name('update');
            Route::delete('/{id}', [LayananController::class, 'destroy'])->name('destroy');
        });

        
        // Queue Management
        Route::prefix('queue')->name('queue.')->group(function () {
            Route::get('/', [AdminQueueController::class, 'index'])->name('index');
            Route::put('/{id}/update', [AdminQueueController::class, 'update'])->name('update');
        });
        
        // ADMIN WORKSHOPS
Route::prefix('workshops')->name('workshops.')->group(function () {
    Route::get('/', [AdminWorkshopController::class, 'index'])->name('index');
    Route::get('/create', [AdminWorkshopController::class, 'create'])->name('create');
    Route::post('/store', [AdminWorkshopController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AdminWorkshopController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [AdminWorkshopController::class, 'update'])->name('update');
    Route::delete('/{id}/delete', [AdminWorkshopController::class, 'destroy'])->name('destroy');
});

        //Mekanik Management
        Route::prefix('mekanik')->name('mekanik.')->group(function () {
            Route::get('/', [MekanikController::class, 'index'])->name('index');
            Route::get('/create', [MekanikController::class, 'create'])->name('create');
            Route::post('/store', [MekanikController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [MekanikController::class, 'edit'])->name('edit');
            Route::put('/{id}', [MekanikController::class, 'update'])->name('update');
            Route::delete('/{id}', [MekanikController::class, 'destroy'])->name('destroy');
        });

        // Finance/Laporan Keuangan (NEW)
        Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
        Route::get('/finance/export', [FinanceController::class, 'export'])->name('finance.export');
        
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
    
    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    
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

    // Profile
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
});
