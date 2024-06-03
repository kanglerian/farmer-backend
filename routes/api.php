<?php

use App\Http\Controllers\API\ControllingController;
use App\Http\Controllers\API\DetailControllingController;
use App\Http\Controllers\API\DetailMaintenanceController;
use App\Http\Controllers\API\DetailRoleDeviceController;
use App\Http\Controllers\API\DevicesController;
use App\Http\Controllers\API\MaintenancesController;
use App\Http\Controllers\API\RoleDeviceController;
use App\Http\Controllers\API\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UsersController::class, 'get_all']);
Route::get('/user/{id}', [UsersController::class, 'get_one']);

Route::get('/roledevices', [RoleDeviceController::class, 'get_all']);
Route::get('/roledevice/{id}', [RoleDeviceController::class, 'get_one']);

Route::get('/maintenances', [MaintenancesController::class, 'get_all']);
Route::get('/maintenance/{id}', [MaintenancesController::class, 'get_one']);

Route::get('/devices', [DevicesController::class, 'get_all']);
Route::get('/device/{id}', [DevicesController::class, 'get_one']);

Route::get('/detailmaintenances', [DetailMaintenanceController::class, 'get_all']);
Route::get('/detailmaintenance/{id}', [DetailMaintenanceController::class, 'get_one']);

Route::get('/detailcontrollings', [DetailControllingController::class, 'get_all']);
Route::get('/detailcontrolling/{id}', [DetailControllingController::class, 'get_one']);

Route::get('/controllings', [ControllingController::class, 'get_all']);
Route::get('/controlling/{id}', [ControllingController::class, 'get_one']);
