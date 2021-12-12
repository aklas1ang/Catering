<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\VariantController;

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

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::get('/packages', [PackageController::class, 'packages'])->name('packages');
Route::get('/myPackages/{userId}', [PackageController::class, 'myPackages'])->name('myPackages');
Route::get('/package/create', [PackageController::class, 'create'])->name('createPackage');
Route::post('/package', [PackageController::class, 'store']);
Route::get('/dashboard/{userId}', [PackageController::class, 'dashboard'])->name('packagesDashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/myBookings/{userId}', [BookingController::class, 'myBookings'])->name('myBookings');
Route::get('/reservations/{userId}', [BookingController::class, 'reservations'])->name('reservations');
Route::patch('/reservation/confirm/{booking}', [BookingController::class, 'confirmBooking']);
Route::patch('/reservation/decline/{booking}', [BookingController::class, 'declineBooking']);

Route::get('/myPackageBookings/{userId}', [BookingController::class, 'myPackageBookings'])->name('myPackageBookings');
Route::get('/createBooking', [BookingController::class, 'createBooking'])->name('createBooking');
Route::post('/package/booking', [BookingController::class, 'store'])->name('store');

Route::get('/variant/create', [VariantController::class, 'create'])->name('createVariant');
Route::post('/variant', [VariantController::class, 'store']);
Route::get('/myVariants/{userId}', [VariantController::class, 'myVariants'])->name('myVariants');
