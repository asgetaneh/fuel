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
use App\Http\Controllers\TripController;
use App\Http\Controllers\FuelRequestReasonController;
use App\Http\Controllers\StationFuelStoredController;
use App\Http\Controllers\FuelRequestController;
use App\Http\Controllers\FuelDistributesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuelReportController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\PermissionController;


// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::resource('trips', TripController::class);
    Route::resource('fuel-request-reasons', FuelRequestReasonController::class);
    Route::resource('station-fuel-storeds', StationFuelStoredController::class);
    Route::resource('fuel-requests', controller: FuelRequestController::class);
    Route::get('/get-vehicles-by-type/{typeId}', [VehicleController::class, 'getByType']);


    Route::POST('fuel-requests/{fuelRequest}/approve', [FuelRequestController::class, 'approve'])->name('fuel-requests.approve');
    Route::get('fuel-requests/{fuelRequest}/reject', [FuelRequestController::class, 'reject'])->name('fuel-requests.reject');
    Route::resource('fuel-distributes', FuelDistributesController::class);
    Route::resource('fuel-reports', controller: FuelReportController::class);
    Route::get('/get-vehicles-performance', [FuelReportController::class, 'efficencyReport'])->name('fuel-reports.efficency');
    Route::get('/fuel-report/export', [FuelReportController::class, 'export'])->name('fuel-report.export');
    Route::resource( 'users', RegisteredUserController::class);
    Route::post('/users/{user}/assign-role', [RegisteredUserController::class, 'assignRole'])->name('users.assignRole');
    Route::delete('/users/{user}/remove-role/{role}', [RegisteredUserController::class, 'removeRole'])->name('users.removeRole');

    Route::resource('roles', UserRoleController::class);
    Route::resource('permissions', PermissionController::class);





});

require __DIR__.'/auth.php';
