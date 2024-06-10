<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\ControllingController;
use App\Http\Controllers\DetailControllingController;
use App\Http\Controllers\DetailMaintenanceController;
use App\Http\Controllers\DetailRoleDeviceController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\MaintenancesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleDeviceController;
use App\Http\Controllers\UsersController;
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
})->name('welcome');

Route::get('/visimisi', function () {
    return view('visimisi');
})->name('visimisi');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UsersController::class)->middleware('level:1');
    Route::resource('roledevice', RoleDeviceController::class)->middleware('level:1');
    Route::resource('devices', DevicesController::class)->middleware('level:1');
    Route::resource('maintenances', MaintenancesController::class)->middleware('level:0');
    Route::resource('detailroledevice', DetailRoleDeviceController::class)->middleware('level:0');
    Route::resource('detailmaintenance', DetailMaintenanceController::class)->middleware('level:0');
    Route::resource('detailcontrolling', DetailControllingController::class)->middleware('level:0');
    Route::resource('controlling', ControllingController::class)->middleware('level:0');
    Route::resource('api-support', APIController::class);

    Route::get('/get/detailroledevices', [DetailRoleDeviceController::class, 'get_all'])->middleware('level:0');
    Route::get('/get/detailroledevice/{id}', [DetailRoleDeviceController::class, 'get_one'])->middleware('level:0');
});

require __DIR__ . '/auth.php';
