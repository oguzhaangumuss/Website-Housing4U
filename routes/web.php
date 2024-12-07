<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/welcome', 'welcome');
$authMiddleware = [
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
];

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::middleware(['role:admin'])->get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::middleware(['role:user'])->get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});














Route::get('/welcome',[HomeController::class,'welcome']);
Route::get('/about',[HomeController::class,'about']);
Route::get('/services',[HomeController::class,'services']);
Route::get('/rooms',[HomeController::class,'rooms']);
Route::get('/contact',[HomeController::class,'contact']);



Route::get('/catagory',[AdminController::class,'catagory']);
Route::get('/delete_catagory/{id}',[AdminController::class,'delete_catagory']);
Route::post('/add_catagory',[AdminController::class,'add_catagory']);
Route::get('/product',[AdminController::class,'product']);
Route::get('/productspage',[AdminController::class,'productspage']);
Route::post('/add_product',[AdminController::class,'add_product']);
Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
Route::get('/update_product/{id}',[AdminController::class,'update_product']);
Route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);