<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

// Ana sayfa
Route::get('/', function () {
    return view('welcome');
});

// Statik sayfalar
Route::view('/welcome', 'welcome');

// HomeController rotaları
Route::get('/about', [HomeController::class, 'about']);
Route::get('/services', [HomeController::class, 'services']);
Route::get('/rooms', [HomeController::class, 'rooms']);
Route::get('/contact', [HomeController::class, 'contact']);

// Authenticated kullanıcılar için grup
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    // Genel Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin rotaları - Admin rolü ile sadece admin erişebilecek
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Kullanıcı rotaları
    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/dashboard', function () {
            return view('user.dashboard');
        })->name('user.dashboard');
    });
});

// Logout işlemi
Route::post('/logout', [Auth\DashboardController::class, 'logout'])->name('logout');

// Giriş yapmamış kullanıcılar için yönlendirme
Route::middleware('guest')->get('/admin', function () {
    return redirect('/login');  // Giriş yapmamışsa login sayfasına yönlendir.
});

// Logout sonrası yönlendirme
Route::middleware('auth')->get('/logout', function () {
    if (Auth::user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');  // Adminse admin dashboard'a yönlendir
    } else {
        return redirect()->route('dashboard');  // Diğer kullanıcıları genel dashboard'a yönlendir
    }
})->name('logout');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');
    
    Route::get('/admin/users/count', [AdminController::class, 'getUsersCount'])->name('admin.users.count');
