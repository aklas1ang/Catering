<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DetailsController;


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
Route::get('/', [AppController::class, 'index']);

Route::get('/myPackages/{userId}', [PackageController::class, 'myPackages'])->name('myPackages');
Route::get('/package/create', [PackageController::class, 'create'])->name('createPackage');
Route::get('/package/{id}/details', [PackageController::class, 'details'])->name('viewDetails');
Route::post('/package', [PackageController::class, 'store']);
Route::get('/dashboard/{userId}', [PackageController::class, 'dashboard'])->name('packagesDashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/myBookings/{userId}', [BookingController::class, 'myBookings'])->name('myBookings');
Route::get('/myPackageBookings/{userId}', [BookingController::class, 'myPackageBookings'])->name('myPackageBookings');

Route::get('/variant/create', [VariantController::class, 'create'])->name('createVariant');
Route::post('/variant', [VariantController::class, 'store']);
Route::get('/myVariants/{userId}', [VariantController::class, 'myVariants'])->name('myVariants');
