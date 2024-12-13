<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserStatController;
use App\Http\Controllers\TagController;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
// Ana sayfa
Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/profilesettings', [HomeController::class, 'profilesettings'])->name('profile-settings');

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
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        // Oda yönetimi rotaları
        Route::prefix('roomprocess')->name('roomprocess.')->group(function () {
            // saleroom rotası
            Route::get('/saleroom', [RoomController::class, 'saleroom'])->name('saleroom');

            // Diğer oda yönetimi rotaları
           Route::get('/showroom', [RoomController::class, 'showroom'])->name('showroom');
            Route::get('/addsaleroom', [RoomController::class, 'showAddRoomForm'])->name('addsaleroom');
            Route::post('/addsaleroom', [RoomController::class, 'storeRoom'])->name('storeRoom');
            Route::get('/editroom/{id}', [RoomController::class, 'editRoom'])->name('editroom');
            Route::post('/editroom/{id}', [RoomController::class, 'updateRoom'])->name('updateRoom');
            Route::delete('/deleteroom/{id}', [RoomController::class, 'deleteRoom'])->name('deleteroom');
            Route::get('/create-tag', [TagController::class, 'create'])->name('createtag');
            Route::post('/store-tag', [TagController::class, 'store'])->name('storetag');
        });

        // Kullanıcı yönetimi
        Route::prefix('userprocess')->name('userprocess.')->group(function () {
            Route::get('/', [UserStatController::class, 'index'])->name('index');
            Route::get('/create', [UserStatController::class, 'create'])->name('create');
            Route::post('/', [UserStatController::class, 'store'])->name('store');
            Route::get('/{user}', [UserStatController::class, 'show'])->name('show');
            Route::get('/{user}/edit', [UserStatController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserStatController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserStatController::class, 'destroy'])->name('destroy');
        });

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Kullanıcı rotaları - user rolü ile sadece kullanıcı erişebilecek
    Route::middleware(['role:user'])->prefix('user')->group(function () {
        Route::get('/user/dashboard', function () {
            return view('user.dashboard');
        })->name('user.dashboard');
    });

});

// Çıkış işlemi için Fortify kullanarak logout rotası sağlanır. 
// Kendi logout rotanızı tanımlamanıza gerek yoktur. Laravel Fortify, logout işlemini otomatik yapar.
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Giriş yapmamış kullanıcılar için yönlendirme
Route::middleware('guest')->get('/admin', function () {
    return redirect('/login');
});

// Logout sonrası yönlendirme
Route::middleware('auth')->get('/logout', function () {
    if (Auth::user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');  // Adminse admin dashboard'a yönlendir
    } else {
        return redirect()->route('dashboard');  // Diğer kullanıcıları genel dashboard'a yönlendir
    }
})->name('logout');

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

// Admin kullanıcı sayısını alma
Route::get('/admin/users/count', [AdminController::class, 'getUsersCount'])->name('admin.users.count');