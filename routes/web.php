<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\LogController;


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
Route::get('/', [AppController::class, 'index'])->name('menu');

Route::middleware('auth')->group(function() {
    Route::get('/packages', [PackageController::class, 'myPackages'])->name('myPackages');
    Route::get('/package/create', [PackageController::class, 'create'])->name('createPackage');
    Route::delete('/package/{package}', [PackageController::class, 'destroy'])->name('deletePackage');
    Route::get('/dashboard', [PackageController::class, 'dashboard'])->name('packagesDashboard');
    Route::post('/package', [PackageController::class, 'store']);
    Route::get('/package/{package}/edit', [PackageController::class, 'edit'])->name('editPackage');
    Route::patch('/package/{package}/update', [PackageController::class, 'update']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/myBookings', [BookingController::class, 'myBookings'])->name('myBookings');
    Route::get('/reservations', [BookingController::class, 'reservations'])->name('reservations');
    Route::patch('/reservation/confirm/{booking}', [BookingController::class, 'confirmBooking'])->name('confirmBooking');
    Route::patch('/reservation/decline/{booking}', [BookingController::class, 'declineBooking'])->name('declineBooking');
    Route::patch('/reservation/done/{booking}', [BookingController::class, 'doneBooking'])->name('doneBooking');


    Route::get('/myPackageBookings/{userId}', [BookingController::class, 'myPackageBookings'])->name('myPackageBookings');
    Route::middleware('ownBooking')->get('/package/{package}/booking/create', [BookingController::class, 'createBooking'])->name('createBooking');
    Route::post('/package/booking', [BookingController::class, 'store'])->name('store');
    Route::post('/booking/cancel/{booking}', [BookingController::class, 'cancelBooking'])->name('cancelBooking');

    Route::get('/variant/create', [VariantController::class, 'create'])->name('createVariant');
    Route::post('/variant', [VariantController::class, 'store']);
    Route::post('/variant/{variant}', [VariantController::class, 'update'])->name('updateVariant');
    Route::delete('/variant/{variant}', [VariantController::class, 'destroy'])->name('deleteVariant');
    Route::get('/myVariants', [VariantController::class, 'myVariants'])->name('myVariants');
    Route::get('/variant/{variant}/edit', [VariantController::class, 'edit'])->name('editVariant');

    // logs
    Route::get('/logs', [LogController::class, 'index'])->name('logs');
});

Route::get('/', [AppController::class, 'index'])->name('menu');
Route::get('/package/{id}/details', [PackageController::class, 'details'])->name('viewDetails');

