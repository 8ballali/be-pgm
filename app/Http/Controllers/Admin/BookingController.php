<?php

namespace App\Http\Controllers\admin;

use App\Models\Booking;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\status_booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $booking = Booking::get();
        $status = status_booking::get();
        $employee = Employee::get();
        $department = Department::all();
        $logged_in = Auth::id();
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name')->get();
            $name = $employee_name[0]->name;
        }
        return view('admin.booking', compact('booking','employee','department', 'name'));
    }
    public function update(Request $request, $id)
    {
       $booking = Booking::find($id);
       $booking->status = $request->status;
       $booking->save();
       return redirect('/booking');
    }
}
