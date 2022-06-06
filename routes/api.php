<?php

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

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::group(['middleware'=>'auth:api'],function(){
    Route::get('/departemen',[DepartementController::class,'index']);
    Route::post('/departemen',[DepartementController::class,'store']);
    Route::get('/departemen/{id}', [DepartementController::class, 'show']);
    Route::post('/departemen/edit/{departemen}',[DepartementController::class,'update']);
    Route::delete('/departemen/{id}',[DepartementController::class,'destroy']);
    Route::post('/category',[CategoryController::class,'store']);
    Route::get('/category',[CategoryController::class,'index']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::post('/category/edit/{category}',[CategoryController::class,'update']);
    Route::delete('/category/{id}',[CategoryController::class,'destroy']);

});



