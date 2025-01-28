<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserStatController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactInfoController;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
// Ana sayfa
Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/profilesettings', [HomeController::class, 'profilesettings'])->name('profile-settings');

// Statik sayfalar
Route::get('/welcome', [HomeController::class, 'welcome'])->name('home');
Route::get('/rooms', [App\Http\Controllers\Home\HomeController::class, 'rooms'])->name('rooms');

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
            Route::put('/editroom/{id}', [RoomController::class, 'updateRoom'])->name('updateRoom');
            Route::delete('/deleteroom/{id}', [RoomController::class, 'deleteRoom'])->name('deleteroom'); // Eklendi
            Route::get('/create-tag', [TagController::class, 'create'])->name('createtag');
            Route::get('/booked', [BookingController::class, 'booked'])->name('booked');
            Route::post('/booking-form', [BookingController::class, 'booked'])->name('booking-form');
            Route::post('/createbooked', [BookingController::class, 'createbooked'])->name('create-booked');
            Route::post('/store-tag', [TagController::class, 'store'])->name('storetag');
            Route::post('/photo/delete', [RoomController::class, 'deletePhoto'])->name('photo.delete');

        });
        Route::prefix('paymentdetails')->name('paymentdetails.')->group(function () {
            // Ödeme işlemleri sayfası
            Route::get('/', [PaymentController::class, 'index'])->name('index');

            // Ödeme detaylarını düzenlemek için
            Route::get('details/{bookingId}', [PaymentController::class, 'details'])->name('details');

            // Ödeme güncelleme işlemi
            Route::post('process/{bookingId}', [PaymentController::class, 'processPayment'])->name('payment.process');
        });
        //blog yönetimi
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/', [BlogController::class, 'store'])->name('store');
            Route::get('/{blog}', [BlogController::class, 'show'])->name('show');
            Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
            Route::put('/{blog}', [BlogController::class, 'update'])->name('update');
            Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('contact_info')->name('contact_info.')->group(function () {
            Route::get('/index', [ContactInfoController::class, 'index'])->name('index');
            Route::get('/edit', [ContactInfoController::class, 'edit'])->name('edit'); // Düzenleme sayfası
            Route::post('/update', [ContactInfoController::class, 'update'])->name('update'); // Güncelleme işlemi
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
// routes/web.php


Route::get('/room/{id}', [RoomController::class, 'show'])->name('room.details');
Route::get('/room/{id}/book', [RoomController::class, 'book'])->name('room.book');
Route::post('/room/{id}/book', [RoomController::class, 'storeBooking'])->name('room.storeBooking');