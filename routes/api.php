<?php

use App\Http\Controllers\api\AuthController as ApiAuthController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\DepartmentController;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\CategoryController;

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

Route::post('register/admin', [ApiAuthController::class, 'registerAdmin']);
Route::post('register/customer', [CustomerController::class, 'register']);
Route::post('login/admin', [ApiAuthController::class, 'loginAdmin']);
Route::post('login/customer', [CustomerController::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('department', [DepartmentController::class, 'index']);
    Route::get('department/{id}', [DepartmentController::class, 'show']);
    Route::get('logout', [CustomerController::class, 'logout']);
    Route::post('department/add', [DepartmentController::class, 'add']);
    Route::post('department/edit/{department}', [DepartmentController::class, 'update']);
    Route::delete('department/delete/{department}', [DepartmentController::class, 'delete']);
    Route::get('customer/{id}', [CustomerController::class, 'show']);
    Route::post('customer/edit/{customer}', [CustomerController::class, 'update']);

});


