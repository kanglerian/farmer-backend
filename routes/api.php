<?php

use App\Http\Controllers\API\ControllingController;
use App\Http\Controllers\API\DetailControllingController;
use App\Http\Controllers\API\DeviceController;
use App\Http\Controllers\API\MaintenanceController;
use App\Http\Controllers\API\SubdeviceController;
use App\Http\Controllers\API\UserController;
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
