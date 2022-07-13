<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\admin\ComplaintsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\admin\HistoryMemoController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\admin\MemoController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\admin\StatusBookingController;
use App\Http\Controllers\api\BookingController;
use App\Http\Middleware\Role;
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
    return view('admin.form-login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'index']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//employee

Route::group(['middleware' => ['admin']], function () {
    Route::GET('/employee',[EmployeeController::class,'index']);
    Route::post('employee',[EmployeeController::class,'store'])->name('employee.store');
    Route::post('employee/edit/{id}',[EmployeeController::class,'update'])->name('employee.update');
    Route::delete('employee/delete/{user_id}',[EmployeeController::class,'delete'])->name('employee.destroy');
    Route::GET('/meeting',[MeetingController::class,'index']);
    Route::post('/meeting',[MeetingController::class,'store'])->name('meeting.store');
    Route::delete('/meeting/{id}',[MeetingController::class,'destroy'])->name('meeting.destroy');
    Route::put('meeting/edit/{id}',[MeetingController::class,'update'])->name('meeting.update');
    Route::GET('/complaint',[ComplaintsController::class,'index']);
    Route::put('complaint/edit/{id}',[ComplaintsController::class,'update'])->name('complaint.update');
    Route::GET('/memo',[MemoController::class,'index']);
    Route::post('/memo',[MemoController::class,'store'])->name('memo.store');
    Route::put('memo/history/add/{memo_id}',[HistoryMemoController::class,'store'])->name('history.store');
    Route::GET('/memo/history/{memo_id}',[HistoryMemoController::class,'index'])->name('memo.history');
    Route::GET('/memo/history/bukti/download/{memo_id}',[HistoryMemoController::class,'download'])->name('history.download');
    Route::GET('/status-booking',[StatusBookingController::class,'index']);
    Route::GET('/booking',[AdminBookingController::class,'index'])->name('booking');
    Route::put('/booking/edit/{id}',[AdminBookingController::class,'update'])->name('booking.update');
    Route::post('/status-booking',[StatusBookingController::class,'store'])->name('status.store');
    Route::put('/status-booking/edit/{status_id}',[StatusBookingController::class,'update'])->name('status.update');
    Route::delete('/status-booking/delete/{id}',[StatusBookingController::class,'destroy'])->name('status.destroy');
    Route::GET('/booking/bukti/download/{booking_id}',[AdminBookingController::class,'download'])->name('booking.download');
});
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['admin', 'employee']], function () {
    Route::GET('/department',[DepartmentController::class,'index'])->name('department');
    Route::post('department',[DepartmentController::class,'store'])->name('department.store');
    Route::put('department/edit/{id}',[DepartmentController::class,'update'])->name('department.update');
    Route::delete('/department/{id}',[DepartmentController::class,'destroy'])->name('department.destroy');
    Route::post('employee/edit/{id}',[EmployeeController::class,'update'])->name('employee.update');
    Route::post('/employee/{id}',[EmployeeController::class,'destroy'])->name('employee.destroy');
    Route::GET('/categories',[CategoriesController::class,'index']);
    Route::post('/categories',[CategoriesController::class,'store'])->name('category.store');
    Route::put('categories/edit/{id}',[CategoriesController::class,'update'])->name('category.update');
    Route::delete('/categories/{id}',[CategoriesController::class,'destroy'])->name('category.destroy');
    Route::GET('/customer',[CustomerController::class,'index']);
    Route::post('customer',[CustomerController::class,'store'])->name('customer.store');
    Route::delete('customer/delete/{user_id}',[CustomerController::class,'delete'])->name('customer.destroy');
    Route::post('customer/edit/{id}',[CustomerController::class,'update'])->name('customer.update');
    Route::GET('/product',[ProductController::class,'index']);
    Route::post('product',[ProductController::class,'store'])->name('product.store');
    Route::delete('/product/{id}',[ProductController::class,'destroy'])->name('product.destroy');
    Route::put('product/edit/{id}',[ProductController::class,'update'])->name('product.update');
});
