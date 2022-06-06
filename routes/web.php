<?php

use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/layouts', function () {
    return view('layouts.app');
});

Route::get('/', function () {
    return view('auth.login');
});

//employee
Route::GET('/employee',[EmployeeController::class,'index']);
Route::post('employee',[EmployeeController::class,'store'])->name('employee.store');
Route::post('employee/edit/{id}',[EmployeeController::class,'update'])->name('employee.update');
Route::post('/employee/{id}',[EmployeeController::class,'destroy'])->name('employee.destroy');
