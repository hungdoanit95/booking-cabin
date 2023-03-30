<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/tim-kiem', [App\Http\Controllers\BookingController::class, 'viewFindBooking']);
Route::post('/find-bookings', [App\Http\Controllers\BookingController::class, 'findBooking'])->name('find.bookings');
Route::get('/', [App\Http\Controllers\BookingController::class, 'index'])->name('booking');
Route::post('/creater-or-update', [App\Http\Controllers\BookingController::class, 'createOrUpdate'])->name('creater.or.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
