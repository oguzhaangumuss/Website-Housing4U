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
Route::get('/welcome', [HomeController::class, 'welcome']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/services', [HomeController::class, 'services']);
Route::get('/rooms', [HomeController::class, 'rooms']);
Route::get('/contact', [HomeController::class, 'contact']);

// Authenticated kullanıcılar için grup
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    // Genel Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin rotaları
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
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
// routes/web.php
Route::middleware(['role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
