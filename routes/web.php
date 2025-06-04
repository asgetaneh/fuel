<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StationController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\VehiclePerformanceController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\FuelPriceController;


Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



     Route::resource('stations', StationController::class);
     Route::resource('vehicle-types', VehicleTypeController::class);
     Route::resource('drivers', DriverController::class);
     Route::resource('vehicles', VehicleController::class);
     Route::resource('offices', controller: OfficeController::class);
     Route::resource('vehicle-performances', VehiclePerformanceController::class);
     Route::resource('measurements', MeasurementController::class);
     Route::resource('fuels', FuelController::class);
    Route::resource('fuel-prices', FuelPriceController::class);



});

require __DIR__.'/auth.php';
