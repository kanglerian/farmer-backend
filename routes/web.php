<?php

use App\Http\Controllers\ControllingController;
use App\Http\Controllers\DetailControllingController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubdeviceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class)->middleware('role:Administrator');
    Route::resource('devices', DeviceController::class)->middleware('role:Administrator');
    Route::resource('subdevices', SubdeviceController::class)->middleware('role:Administrator');
    Route::resource('maintenances', MaintenanceController::class)->middleware('role:Administrator');
    Route::resource('controlling', ControllingController::class)->middleware('role:Administrator');
    Route::resource('detailcontrolling', DetailControllingController::class)->middleware('role:Administrator');
});

require __DIR__.'/auth.php';
