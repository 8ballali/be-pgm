<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\status_booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusBookingController extends Controller
{
    public function index()
    {
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
        return view('admin.status-booking', compact('status','employee','department', 'name'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        status_booking::create([
            'name' => $request->name,
        ]);
        return redirect()->back();
    }
    public function update(Request $request, $status_id)
    {
        $status = status_booking::find($status_id);
        $status->name = $request->name;
        $status->save();
        return redirect()->back();
    }
    public function destroy($id)
    {
        $status = status_booking::find($id);
        $status->delete();
        return redirect()->back();
    }
}
